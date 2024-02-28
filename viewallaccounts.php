<?php
session_start();
$apassword=$_SESSION['apassword'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - View all accounts</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Administration - View all accounts</h1>";

//Check if the password is okay+activity
if ($apassword==$other['apassword'])
{
?>
<table cellspacing=1 cellpadding=5><tr><td>Login</td><td>Name</td><td>Description</td><td>Balance</td><td>Active</td><td>Email</td></tr>
	<?php
	$query="SELECT * FROM `phpb_accounts` ORDER BY login ASC";
	$result=mysql_query($query,$db);
	while ($displayaccount=mysql_fetch_array($result))
	{
		if ($displayaccount['active'])
		{$active="Yes";}
		else
		{$active="No";}
		echo "<tr><td>".$displayaccount['login'];
		echo "</td><td>".$displayaccount['name'];
		echo "</td><td>".$displayaccount['description'];
		echo "</td><td>".$other['currencysymbol']." ".$displayaccount['balance'];
		echo "</td><td>".$active;
		echo "</td><td>".$displayaccount['email'];
		echo "</td></tr>";
	}
	?>
</table>
<br>
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
