<?php
session_start();
$apassword=$_SESSION['apassword'];
session_destroy();

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
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - Logging out</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ ME">
<link rel=stylesheet type=text/css href="style.php">
</HEAD>

<BODY>
<table height=100% width=100% class=centertable><tr><td class=centertable height=100% width=100% valign=middle align=center>
<table cellpadding=15><tr><td align=center>
<img src="<?php echo $other['topimg']; ?>">
<?php
echo "<h1>".$other['nation']." - PHPBank: Administration - Logging out</h1>";
?>
<h2>You are now logged out of the Admin CP.</h2>
<a href="index.php">Index</a>

</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
