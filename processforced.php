<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - Processing forced transaction</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Processing forced transaction</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
$from=$_POST['fromaccount'];
$to=$_POST['toaccount'];
$amount=$_POST['amount'];
$comments=$_POST['comments'];
$timestamp=time();

//Check
if (!$amount)
{die ('<h3>ERROR: No amount specified!</h3><a href="admincp.php">Admin CP</a>');}

 function checkChars($stringToCheck,$allowedChars)
      {
      $returnvalue=TRUE;
         for ($i=0;$i!=strlen($stringToCheck);$i++)
         {
         $curchar = substr($stringToCheck, $i, 1);
         if (!strstr($allowedChars,$curchar))
         {$returnvalue=FALSE;}
         }
      return $returnvalue;
      }
if (!checkChars($amount,"1234567890."))
{die ('<h3>ERROR: Please use only nummers in the amount, and "." for decimals.</h3><a href="admincp.php">Admin CP</a>');}

if ($amount==0)
{die ('<h3>ERROR: The amount may not be 0.</h3><a href="admincp.php">Admin CP</a>');}

if (strlen($comments)>30)
{die ('<h3>ERROR: The comment is longer than 30 characters. Please limit its length to 30 at max.</h3><a href="admincp.php">Admin CP</a>');}
$comment="FORCED:".$comments;

if ($from==$to)
{die ('<h3>ERROR: Sender and receiver of the money are the same!</h3><a href="admincp.php">Admin CP</a>');}



//get balances
$query="SELECT * FROM `phpb_accounts` WHERE `id`='$from'";
$result=mysql_query($query,$db);
$fromaccount=mysql_fetch_array($result);
$query="SELECT * FROM `phpb_accounts` WHERE `id`='$to'";
$result=mysql_query($query,$db);
$toaccount=mysql_fetch_array($result);


//amount may not be bigger than the balance of the sender
   if ($amount>$fromaccount['balance'])
   {die ('<h3>ERROR: The sender does not have this amount of money. Please try again when he has.</h3><a href="admincp.php">Admin CP</a>');}


//calculate new balances
$newfromamount=$fromaccount['balance']-$amount;
$newtoamount=$toaccount['balance']+$amount;

//store new balances
$query="UPDATE `phpb_accounts` SET `balance`='$newfromamount' WHERE `id`='$from'";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: There is something wrong with the database: the balances did not get stored. Please try again later.</h3><a href="admincp.php">Admin CP</a>');}
$query="UPDATE `phpb_accounts` SET `balance`='$newtoamount' WHERE `id`='$to'";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: There is something wrong with the database: One of the balances did not get stored. This is a serious error! Please contact the development.</h3><a href="admincp.php">Admin CP</a>');}

//record transaction
$query="INSERT INTO `phpb_transactions` (`requester`,`acceptor`,`direction`,`amount`,`comment`,`status`,`timestamp`) VALUES ('$from','$to','1','$amount','$comment','1','$timestamp')";
$result=mysql_query($query,$db);

//update stats
$query="UPDATE `phpb_other` SET `transactions`=(transactions+1), `latesttransaction`='$timestamp'";
mysql_query($query,$db);
?>


<h2>The transaction was FORCED.</h2>
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
