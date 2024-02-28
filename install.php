<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Installation</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ ME">
<style>

<!-- 
body { background-color: #FFFFFF; color: #000000; font-size: 11px; font-family: "Tahoma"; }

table { background-color: #000000; }

.centertable { background-color: #FFFFFF; }

td { background-color: #FFFFFF; font-size: 11px; font-family: "Tahoma"; }

i { font-size: 12px; font-style : italic; font-family: "Tahoma"; }

a { font-weight:bold; text-decoration: none; color: #888888; }

a:hover { font-weight:bold; text-decoration: none; color: #BBBBBB; }

h1 { color: #444444; font-size: 15px; font-weight:bold; }

h2 { color: #888888; font-size: 13px; font-weight:bold; }

h3 { color: #FF0000; font-size: 11px; font-weight:bold; }

--> 
</style>
</HEAD>
<BODY>
<table height=100% width=100% class=centertable><tr><td class=centertable height=100% width=100% valign=middle align=center>
<table cellpadding=15><tr><td align=center colspan=2>
<img src="topimg.png">
<h1>PHPBank Installation</h1>
Welcome to the PHPBank installation. Thank you for choosing us!<br>
(not that you have much choice, anyways :-P)<br><br>
<h2>Before installing...</h2>
...make sure that you have uploaded everything correctly.<br>You also have to edit the config.php file, for example in notepad. Make sure that all this has been done.
<h2>Requirements</h2>
PHPBank requires:<br>
- PHP4; It was programmed in PHP4.2.3 but it will probably work with older versions too.<br>
- MySQL; It was programmed in MySQL 3.23.32 which is a fairly old version.<br>
- Note: Before installing, make sure that PHP supports the <b>mail</b>(); function!<br>
<h2>Bank data</h2>
<form name=data action="doinstall.php" method=post>
<table width=100% cellspacing=0><tr><td width=33%>
Full nation name:<br><input type=text name=nation>
</td><td width=33%>
Currency symbol:<br><input type=text name=currencysymbol>
</td><td width=33%>
Administration password:<br><input type=text name=apassword>
</td></tr><tr><td colspan=3 align=center><br>
Message for the index page (you may use HTML):<br>
<textarea name=intromessage cols=40 rows=4></textarea><br><br>
</td></tr></table>

<h2>Government bank account data</h2>
The government bank account functions just like any other account,<br>
except that it has a lot of money in it from start :)<br>
This starting amount is very important as it can not be changed.<br><br>
<!-- login password name description balance email -->
<table width=100% cellspacing=0><tr><td width=33%>
Log in:<br><input type=text name=login>
</td><td width=33%>
Password:<br><input type=text name=password>
</td><td width=33%>
Account name:<br><input type=text name=name>
</td></tr><tr><td>
Description:<br><textarea name=description cols=15 rows=3></textarea>
</td><td>
Starting balance:<br><input type=text name=balance><br>Consider this very carefully!
</td><td>
Email:<br><input type=text name=email>
</td></tr></table>
<br><input type="submit" value="Install PHPBank">
</form>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
