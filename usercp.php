<?php
session_start();
if(!isset($_SESSION['password']))
{
$login=$_POST['login'];
$password=md5($_POST['password']);
$_SESSION['login']=$login;
$_SESSION['password']=$password;
}
else
{
$login=$_SESSION['login'];
$password=$_SESSION['password'];
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - UserCP</TITLE>
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

//get account info
$query="SELECT * FROM `phpb_accounts` where `login`='$login'";
$result=mysql_query($query,$db);
$account=mysql_fetch_array($result);
$accountid=$account['id'];
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
echo "<h1>".$other['nation']." - PHPBank: User CP</h1>";
//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{
echo "<h2>".$account['name']." - ".$other['currencysymbol']." ".$account['balance'];
?>
</td></tr><tr><td align=center>
<h2>Pending transactions</h2>
	<table width=100% cellspacing=1><tr><td>Account name</td><td>Direction</td><td>Amount</td><td>Comment</td><td>Action</td></tr>
	<?php
	//First, get transactions that I requested
	$query="SELECT * FROM `phpb_transactions` WHERE `requester`='$accountid'";
	$result=mysql_query($query,$db);
	while ($rqtransaction=mysql_fetch_array($result))
	{
	if ($rqtransaction['status']==0)
	{
	//get other guy's name
	$acid=$rqtransaction['acceptor'];
	$query="SELECT * FROM `phpb_accounts` WHERE `id`='$acid'";
	$result2=mysql_query($query,$db);
	$acaccount=mysql_fetch_array($result2);
	if ($rqtransaction['direction'])
	{$direction="Outgoing";}
	else
	{$direction="Incoming";}
	echo "<tr><td>".$acaccount['name']."</td><td>".$direction."</td><td>".$other['currencysymbol']." ".$rqtransaction['amount']."</td><td>".$rqtransaction['comment']."</td><td>";
	echo "<form style='display: inline;' action='cancel.php' method=post><input type=hidden name=transactionid value='".$rqtransaction['id']."'><input type=submit value='Cancel'></form>";
	echo "</td></tr>";
	}
	}
	?>
	</table><br><br>
	
	<table width=100% cellspacing=1><tr><td>Account name</td><td>Direction</td><td>Amount</td><td>Comment</td><td>Action</td></tr>
	<?php
	//Then, get transactions that I am acceptor of
	$query="SELECT * FROM `phpb_transactions` WHERE `acceptor`='$accountid'";
	$result=mysql_query($query,$db);
	while ($actransaction=mysql_fetch_array($result))
	{
	if ($actransaction['status']==0)
	{
	//get other guy's name
	$rqid=$actransaction['requester'];
	$query="SELECT * FROM `phpb_accounts` WHERE `id`='$rqid'";
	$result2=mysql_query($query,$db);
	$rqaccount=mysql_fetch_array($result2);
	if ($actransaction['direction'])
	{$direction="Incoming";}
	else
	{$direction="Outgoing";}
	echo "<tr><td>".$rqaccount['name']."</td><td>".$direction."</td><td>".$other['currencysymbol']." ".$actransaction['amount']."</td><td>".$actransaction['comment']."</td><td>";
	echo "<form style='display: inline;' action='accept.php' method=post><input type=hidden name=transactionid value='".$actransaction['id']."'><input type=submit value='Accept'></form>";
	echo "<form style='display: inline;' action='deny.php' method=post><input type=hidden name=transactionid value='".$actransaction['id']."'><input type=submit value='Deny'></form>";
	echo "</td></tr>";
	}
	}
	?>
	</table>

</td></tr><tr><td align=center>
<h2>New transaction</h2>
who direction amount comment
<form name=newtransaction action="processnewtransaction.php" method=post>
<table width=100% cellspacing=0><tr><td width=33%>
Who with:<br>
<select name=who>
<?php
$query="SELECT * FROM `phpb_accounts`";
$result=mysql_query($query,$db);
while ($listaccount=mysql_fetch_array($result))
{
if ($listaccount['id']!=$account['id'])
	{
	echo "<option value='".$listaccount['id']."'>".$listaccount['name'];
	}
}
?>
</select>
</td><td width=33%>
Direction:<br>
<input type=radio name=direction value="1" checked>Send money<br>
<input type=radio name=direction value="0">Request money<br>
</td><td width=33%>
Amount:<br>
<input type=text name=amount><br>
Enter only numbers
</td></tr><tr><td colspan=2>
Comment:<br>
<textarea name=comment rows=3 cols=20></textarea><br>Max. 40 characters
</td><td>
<input type=submit value="Create transaction">
</td></tr></table>
</form>

</td></tr><tr><td align=center>
<?php
echo $account['description'];
?>
</td></tr><tr><td align=center>
<a href="accepted.php">Accepted transactions</a> - <a href="denied.php">Denied transactions</a> - <a href="details.php">Change account details</a> - <a href="logout.php">Log out</a>
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
