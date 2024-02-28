<?php
session_start();
if(!isset($_SESSION['apassword']))
{
$apassword=$_POST['apassword'];
$_SESSION['apassword']=$apassword;
}
else
{
$apassword=$_SESSION['apassword'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - CP</TITLE>
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
echo "<h1>Administration CP</h1>";
//Check if the password is okay
if ($apassword==$other['apassword'])
{
//layout
$query="SELECT * FROM `phpb_layout`";
$result=mysql_query($query,$db);
$layout=mysql_fetch_array($result);

?>
<h2>Layout</h2>
Be careful while editing the layout: if everything becomes unreadable, you won't be able to read this either!
<form name=layout action="processlayout.php" method=post>
   <table width=100% cellspacing=0 cellpadding=0><tr><td width=33%>
   Border color<br>
   <input type=text name=bordercolor value="<?php echo $layout['bordercolor']; ?>">
   </td><td width=33%>
   Background color<br>
   <input type=text name=backgroundcolor value="<?php echo $layout['bgcolor']; ?>">
   </td><td width=33%>
   Background color inside table<br>
   <input type=text name=insidecolor value="<?php echo $layout['insidecolor']; ?>">
   </td></tr><tr><td>
   Title text color<br>
   <input type=text name=h1color value="<?php echo $layout['h1color']; ?>">
   </td><td>
   Title text size<br>
   <input type=text name=h1size value="<?php echo $layout['h1size']; ?>">
   </td><td>
   Important info text color<br>
   <input type=text name=h2color value="<?php echo $layout['h2color']; ?>">
   </td></tr><tr><td>
   Important info text size<br>
   <input type=text name=h2size value="<?php echo $layout['h2size']; ?>">
   </td><td>
   Error text color<br>
   <input type=text name=h3color value="<?php echo $layout['h3color']; ?>">
   </td><td>
   Error text size<br>
   <input type=text name=h3size value="<?php echo $layout['h3size']; ?>">
   </td></tr><tr><td>
   Link color<br>
   <input type=text name=acolor value="<?php echo $layout['acolor']; ?>">
   </td><td>
   Link hover color<br>
   <input type=text name=ahovercolor value="<?php echo $layout['ahovercolor']; ?>">
   </td><td>
   Text size<br>
   <input type=text name=size value="<?php echo $layout['size']; ?>">
   </td></tr><tr><td>
   Text color<br>
   <input type=text name=textcolor value="<?php echo $layout['textcolor']; ?>">
   </td><td>
   Font<br>
   <input type=text name=font value="<?php echo $layout['font']; ?>">
   </td><td>
   <input type=submit value="Edit layout">
   </td></tr></table>
</form>
</td></tr><tr><td align=center>
<h2>Other Information</h2>
<form name=other action="processother.php" method=post>
   <table cellspacing=0 cellpadding=0 width=100%><tr><td width=50%>
   Top Image URL<br>
   <input type=text name=topimg value="<?php echo $other['topimg']; ?>">
   </td><td width=50%>
   Nation name<br>
   <input type=text name=nation value="<?php echo $other['nation']; ?>">
   </td></tr><tr><td>
   Index message<br>
   <textarea cols=25 rows=4 name=intromsg><?php echo $other['intromessage']; ?></textarea>
   </td><td>
   Currency Symbol<br>
   <input type=text name=currencysymbol value="<?php echo $other['currencysymbol']; ?>">
   </td></tr><tr><td>
   Admin Password<br>
   <input type=text name=adminpassword value="<?php echo $other['apassword']; ?>">
   </td><td>
   <input type=submit value="Edit other information">
   </td></tr></table>
</form>
</td></tr><tr><td align=center>
<h2>Account activation</h2>
Over here, the accounts that are awaiting activation can be activated.<br>
	<table width=100% cellspacing=1>
	<tr><td>Login</td><td>Name</td><td>Email</td><td>Description</td><td>Activate</td></tr>
	<?php
	$query="SELECT * FROM `phpb_accounts` WHERE `active`='0'";
	$result=mysql_query($query,$db);
	while ($activateaccount=mysql_fetch_array($result))
	{
		echo "<tr><td>".$activateaccount['login']."</td><td>".$activateaccount['name']."</td><td>".$activateaccount['email']."</td><td>".$activateaccount['description']."</td><td>";
		echo "<form style='display: inline;' action='activate.php' method=post><input type=hidden name=accountid value='".$activateaccount['id']."'><input type=submit value='Activate'></form>";
		echo "<form style='display: inline;' action='delete.php' method=post><input type=hidden name=accountid value='".$activateaccount['id']."'><input type=submit value='Delete'></form>";
	}
	?>
	</table>
</td></tr><tr><td align=center>
<h2>Force a transaction</h2>
<form name=forcetransaction action="processforced.php" method=post>
	<table width=100% cellspacing=0><tr><td width=50%>
	Transfer money from:<br>
	<select name=fromaccount>
	<?php
	$query="SELECT * FROM `phpb_accounts`";
	$result=mysql_query($query,$db);
	while ($fromaccount=mysql_fetch_array($result))
	{
		echo "<option value='".$fromaccount['id']."'>".$fromaccount['login'];
	}
	?>
	</select>
	</td><td width=50%>
	To:<br>
	<select name=toaccount>
	<?php
	$query="SELECT * FROM `phpb_accounts`";
	$result=mysql_query($query,$db);
	while ($toaccount=mysql_fetch_array($result))
	{
		echo "<option value='".$toaccount['id']."'>".$toaccount['login'];
	}
	?>
	</select>
	</td></tr><tr><td>
	Amount (only numbers):<br>
	<?php
	echo $other['currencysymbol']." ";
	?><input type=text name=amount>	
	</td><td>
	Comments:<br>
	<textarea name=comments></textarea>
	</td></tr></table>
	<input type=submit value="Force transaction">
</form>

</td></tr><tr><td align=center>
<a href="viewallaccounts.php">View all accounts</a> - <a href="viewalltransactions.php">View all transactions</a> - <a href="alogout.php">Log out</a>
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
