<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Denied transactions history</TITLE>
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

$query="SELECT * FROM `phpb_other`";
$result=mysql_query($query,$db);
$other=mysql_fetch_array($result);
?>
<BODY>
<table height=100% width=100% class=centertable><tr><td class=centertable height=100% width=100% valign=middle align=center>
<table cellpadding=15><tr><td align=center>
<img src="<?php echo $other['topimg']; ?>">
<?php
echo "<h1>".$other['nation']." - PHPBank: Denied transactions history</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{
$accountid=$account['id'];
?>
<h2>Denied by you:</h2>
<table cellspacing=1 cellpadding=5><tr>
<td>Requester</td><td>Direction</td><td>Amount</td><td>Comment</td><td>Date/Time</td>
</tr>
<?php
$query="SELECT * FROM `phpb_transactions` WHERE `acceptor`='$accountid' AND `status`='2' ORDER BY `timestamp` DESC";
$result=mysql_query($query,$db);
while ($transactions=mysql_fetch_array($result))
{
$query="SELECT * FROM `phpb_accounts` WHERE `id`='".$transactions['requester']."'";
$result2=mysql_query($query,$db);
$requesterarray=mysql_fetch_array($result2);
echo "<tr><td>".$requesterarray['name']."</td>";
if ($transactions['direction'])
{$direction="Incoming";}
else
{$direction="Outgoing";}
echo "<td>".$direction."</td>";
echo "<td>".$other['currencysymbol']." ".$transactions['amount']."</td>";
echo"<td>".$transactions['comment']."</td>";
$datetime=date ("D j F, g:i A", $transactions['timestamp']);
echo "<td>".$datetime."</td></tr>";
}
?>
</table>


<h2>Denied by others:</h2>
<table cellspacing=1 cellpadding=5><tr>
<td>Denier</td><td>Direction</td><td>Amount</td><td>Comment</td><td>Date/Time</td>
</tr>
<?php
$query="SELECT * FROM `phpb_transactions` WHERE `requester`='$accountid' AND `status`='2' ORDER BY `timestamp` DESC";
$result=mysql_query($query,$db);
while ($transactions=mysql_fetch_array($result))
{
$query="SELECT * FROM `phpb_accounts` WHERE `id`='".$transactions['acceptor']."'";
$result2=mysql_query($query,$db);
$acceptorarray=mysql_fetch_array($result2);
echo "<tr><td>".$acceptorarray['name']."</td>";
if ($transactions['direction'])
{$direction="Outgoing";}
else
{$direction="Incoming";}
echo "<td>".$direction."</td>";
echo "<td>".$other['currencysymbol']." ".$transactions['amount']."</td>";
echo"<td>".$transactions['comment']."</td>";
$datetime=date ("D j F, g:i A", $transactions['timestamp']);
echo "<td>".$datetime."</td></tr>";
}
?>
</table>

<br><br><a href="usercp.php">User CP</a>
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
