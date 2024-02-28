<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>Untitled</TITLE>
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
<img
<?php
//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{

?>



<?php
}
else
{
echo "You are trying to view an account that is not activated yet.";
session_destroy();
}
}
else
{
echo "Wrong Password. Please try again by hitting the back button of your browser.";
session_destroy();
}
?>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
