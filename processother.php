<?php
session_start();
$apassword=$_SESSION['apassword'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - Process layout change</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Process other information edit</h1>";
//Check if the password is okay+activity
if ($apassword==$other['apassword'])
{
$topimg=$_POST['topimg'];
$nation=$_POST['nation'];
$intromsg=$_POST['intromsg'];
$currencysymbol=$_POST['currencysymbol'];
$adminpassword=$_POST['adminpassword'];

$query="UPDATE `phpb_other` SET `topimg`='$topimg',`nation`='$nation',`intromessage`='$intromsg',`currencysymbol`='$currencysymbol',`apassword`='$adminpassword'";
$result=mysql_query($query,$db);
if (!$result)
{die("<h3>ERROR: The information was not changed. Please try again later.</h3>");}
?>
The information was successfully updated. If you have changed the password, you will have to log out now and log in again with the new password, or you will receive wrong password errors.<br><br>
<a href="admincp.php">Admin CP</a> - <a href="alogout.php">Log out</a> 
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
