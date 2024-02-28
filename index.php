<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Main</TITLE>
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
<table cellpadding=15><tr><td align=center colspan=2>
<img src="<?php echo $other['topimg']; ?>">
<?php
echo "<h1>".$other['nation']." - PHPBank</h1>";
echo $other['intromessage'];
?>
</td></tr><tr><td align=center>
<h2>Stats</h2>
<?php
echo "Accounts: ".$other['accounts']."<br>";
echo "Transactions: ".$other['transactions']."<br>";
if ($other['latesttransaction'])
{$transdate=date("D j F, g:i A", $other['latesttransaction']);
echo "Latest transaction:<br>".$transdate."<br>";}
else
{echo "Latest transaction:<br>No transactions yet<br>";}
?>
Version: 1.0<br>
</td><td align=center>
<a href="login.php">Log in</a><br>
<a href="register.php">Register an account</a><br>
<a href="alogin.php">Administration</a>
</td></tr></table>
<div style="font-size: 8px;">PHPBank is micro(c) <a href="mailto:sanderdieleman[at]hotmail[dot]com">Sander Dieleman</a>, 2004. Leave this message intact.</div>
</td></tr></table>
</BODY>
</HTML>
