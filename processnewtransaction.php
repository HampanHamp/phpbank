<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Processing new transaction</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Processing new transaction</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{

//get data
$requester = strip_tags($account['id']);
$acceptor = strip_tags($_POST['who']);
$direction = strip_tags($_POST['direction']);
$amount = strip_tags($_POST['amount']);
$comment = strip_tags($_POST['comment']);
$timestamp = mktime();
//Check

if (!$acceptor)
{die ('<h3>ERROR: There is nobody to do a transaction with!</h3><a href="usercp.php">User CP</a>');}
if (!$amount)
{die ('<h3>ERROR: No amount specified!</h3><a href="usercp.php">User CP</a>');}

 function checkChars($stringToCheck,$allowedChars)
      {
      $returnvalue=TRUE;
         for ($i=0;$i!=strlen($stringToCheck);$i++)
         {
         $curchar = substr($stringToCheck, $i, 1);
         if (!strstr($allowedChars,$curchar))
         {$returnvalue=FALSE;}
         }
      return $returnvalue;
      }
if (!checkChars($amount,"1234567890."))
{die ('<h3>ERROR: Please use only nummers in the amount, and "." for decimals.</h3><a href="usercp.php">User CP</a>');}

if ($amount==0)
{die ('<h3>ERROR: The amount may not be 0.</h3><a href="usercp.php">User CP</a>');}

if (strlen($comment)>40)
{die ('<h3>ERROR: The comment is longer than 40 characters. Please limit its length to 40 at max.</h3><a href="usercp.php">User CP</a>');}

//if all went well, insert transaction! Requester - Acceptor - Direction - Amount - Comment - Status
$query="INSERT INTO `phpb_transactions` (`requester`,`acceptor`,`direction`,`amount`,`comment`,`status`) VALUES ('$requester','$acceptor','$direction','$amount','$comment','0')";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: The transaction failed to be inserted into the database! Please try again later.</h3><a href="usercp.php">User CP</a>');}
?>
<h2>The transaction is now pending. You may cancel it as long as it hasn't been accepted.</h2>
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
