<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Denying transaction</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ ME">
<link rel=stylesheet type=text/css href="style.php">
</HEAD>
<?php
require "config.php";
if ($datpass=="")
{$db = mysql_connect($dathost, $datusr);}
else
{$db = mysql_connect($dathost, $datusr, $datpass);}
mysql_select_db($datname,$db);

//Get Account Information
$query="SELECT * FROM `phpb_accounts` where `login`='$login'";
$result=mysql_query($query,$db);
$account=mysql_fetch_array($result);

//get Other information
$query="SELECT * FROM `phpb_other`";
$result=mysql_query($query,$db);
$other=mysql_fetch_array($result);
?>
<BODY>
<table height=100% width=100% class=centertable><tr><td class=centertable height=100% width=100% valign=middle align=center>
<table cellpadding=15><tr><td align=center>
<img src="<?php echo $other['topimg']; ?>">
<?php
echo "<h1>".$other['nation']." - PHPBank: Denying transaction</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{
$transactionid=$_POST['transactionid'];
//Check if transactions hasn't been deleted in the meantime
$query="SELECT * FROM `phpb_transactions` WHERE `id`='$transactionid'";
$result=mysql_query($query,$db);
$transaction=mysql_fetch_array($result);
if (!$transaction)
{die('<h3>ERROR: This transaction no longer exists. It was probably cancelled.</h3><a href="usercp.php">User CP</a>');}
//Else, continue to checking if transaction is still pending
if ($transaction['status'])
{die('<h3>ERROR: This transaction is no longer pending. It may have been accepted or denied in the meantime.</h3><a href="usercp.php">User CP</a>');}

//Edit Transaction status to denied
$timestamp=mktime();
   $query="UPDATE `phpb_transactions` SET `status`='2',`timestamp`='$timestamp' WHERE `id`='$transactionid'";
   $result=mysql_query($query,$db);
   if (!$result)
   {die ('<h3>ERROR: There is something wrong with the database: the transaction status did not change. Please try again later.</h3><a href="usercp.php">User CP</a>');}
?>

<h2>The transaction was DENIED.</h2>
<a href="usercp.php">User CP</a>

<?php
}
else
{
echo "<h3>ERROR: You are trying to view an account that is not activated yet.</h3>";
session_destroy();
}
}
else
{
echo "<h3>ERROR: Wrong Password. Please try again by hitting the back button of your browser.</h3>";
session_destroy();
}
?>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
