<?php
session_start();
$apassword=$_SESSION['apassword'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - Activate account</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Administration - Activating account</h1>";

//Check if the password is okay+activity
if ($apassword==$other['apassword'])
{

//get email
   $query="SELECT * FROM `phpb_accounts` WHERE `id`='$accountid'";
   $result=mysql_query($query,$db);
   $accountinfo=mysql_fetch_array($result);
//delete
   $accountid=$_POST['accountid'];
   $query="DELETE FROM `phpb_accounts` WHERE `id`='$accountid'";
   $result=mysql_query($query,$db);
   if (!$result)
   {die ("<h3>ERROR: The account couldn't be deleted. Please try again later.</h3>");}
   
mail($accountinfo['email'],"PHPBank: Account deleted","Your account request at the PHPBank of ".$other['nation']." has been turned down.");

   
?>

The account was deleted.<br><br>
<a href="admincp.php">Admin CP</a>

<?php
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
