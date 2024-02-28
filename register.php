<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Register an account</TITLE>
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
<img src="<?php echo $other['topimg']; ?>"><br>
<?php
echo "<h1>".$other['nation']." - PHPBank: Register an account</h1>";
?>
To register your own bankaccount, fill out this form.<br>
Your account will not be usable right away, it needs to be activated first.<br>
You will be notified when the account has been activated.<br><br>
<form name=register method=POST action="processregister.php">
Account Name:<br><input type=text name=name value=""><br><br>
Login:<br><input type=text name=login value=""><br>Only letters! Case insensitive.<br><br>
Your desired password:<br><input type=password name=password1 value=""><br><br>
Your password again:<br><input type=password name=password2 value=""><br><br>
Passwords are case sensitive, and cannot be retrieved!<br><br>
Account Description:<br><textarea name=description></textarea><br>Not required.<br><br>
Your email:<br><input type=text name=email value=""><br><br>
<input type=submit value="send request"><input type=reset value="reset">
<br><br>
</form>
<a href="index.php">Index</a>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
