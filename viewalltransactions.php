<?php
session_start();
$apassword=$_SESSION['apassword'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - View all transactions</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Administration - View all transactions</h1>";

//Check if the password is okay+activity
if ($apassword==$other['apassword'])
{
?>
<table cellspacing=1 cellpadding=5><tr><td>Requester</td><td>Direction</td><td>Acceptor</td><td>Amount</td><td>Comment</td><td>Status</td><td>Time</td></tr>
	<?php
	$query="SELECT * FROM `phpb_transactions` ORDER BY `timestamp` DESC";
	$result=mysql_query($query,$db);
	while ($transactions=mysql_fetch_array($result))
	{
		//get RQlogin
		$RQid=$transactions['requester'];
		$query="SELECT * FROM `phpb_accounts` WHERE `id`='$RQid'";
		$result2=mysql_query($query,$db);
		$RQaccount=mysql_fetch_array($result2);
		$RQlogin=$RQaccount['login'];
		//get AClogin
		$ACid=$transactions['acceptor'];
		$query="SELECT * FROM `phpb_accounts` WHERE `id`='$ACid'";
		$result2=mysql_query($query,$db);
		$ACaccount=mysql_fetch_array($result2);
		$AClogin=$ACaccount['login'];
		//direction
		if ($transactions['direction'])
		{$direction="-->";}
		else
		{$direction="<--";}
		//status
		if ($transactions['status']=="2")
		{$status="Denied";}
		if ($transactions['status']=="1")
		{$status="Accepted";}
		if ($transactions['status']=="0")
		{$status="Pending";}
		//time
		if($transactions['timestamp'])
		{$datetime=date ("D j F, g:i A", $transactions['timestamp']);}
		else
		{$datetime="N/A";}
		//echo
		echo "<tr><td>".$RQlogin;
		echo "</td><td>".$direction;
 		echo "</td><td>".$AClogin;
		echo "</td><td>".$other['currencysymbol']." ".$transactions['amount'];
		echo "</td><td>".$transactions['comment'];
		echo "</td><td>".$status;
		echo "</td><td>".$datetime;
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
