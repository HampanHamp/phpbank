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
<h1>PHPBank Installation - Installing</h1>
<?php
$nation=strip_tags($_POST['nation']);
$currencysymbol=strip_tags($_POST['currencysymbol']);
$apassword=$_POST['apassword'];
$intromessage=$_POST['intromessage'];

$login=strtolower(strip_tags($_POST['login']));
$password=md5($_POST['password']);
$name=strip_tags($_POST['name']);
$description=strip_tags($_POST['description']);
$balance=$_POST['balance'];
$email=strip_tags($_POST['email']);
//Checks
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

if(!checkChars($login,"abcdefghijklmnopqrstuvwxyz"))
{die ("<h3>ERROR: Your login ID can contain only letters.</h3>");}

if(!checkChars($balance,"1234567890."))
{die ("<h3>ERROR: Balance must be a number.</h3>");}

if (strlen($description)>100)
{die ('<h3>ERROR: The description is longer than 100 characters. Please limit its length to 100 at max.</h3>');}

if (strlen($name)>30)
{die ('<h3>ERROR: The account name is longer than 30 characters. Please limit its length to 30 at max.</h3>');}

if (strlen($login)>20)
{die ('<h3>ERROR: The login id is longer than 20 characters. Please limit its length to 20 at max.</h3>');}

//create structure

	//connect
	require "config.php";
	if ($datpass=="")
	{$db = mysql_connect($dathost, $datusr);}
	else
	{$db = mysql_connect($dathost, $datusr, $datpass);}
	mysql_select_db($datname,$db);

$query="CREATE TABLE phpb_accounts ( id int(11) NOT NULL auto_increment, login text NOT NULL, password text NOT NULL, name text NOT NULL, description text NOT NULL, balance text NOT NULL, active int(11) NOT NULL default '0', email text NOT NULL, PRIMARY KEY (id) ) TYPE=MyISAM;";
$result = mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not create the account table. Your MySQL info might not be correct.</h3>');}
echo "..Account table created.<br>";
$query="CREATE TABLE phpb_layout ( bordercolor text NOT NULL, bgcolor text NOT NULL, insidecolor text NOT NULL, h1color text NOT NULL, h1size text NOT NULL, h2color text NOT NULL, h2size text NOT NULL, h3color text NOT NULL, h3size text NOT NULL, acolor text NOT NULL, ahovercolor text NOT NULL, size text NOT NULL, textcolor text NOT NULL, font text NOT NULL ) TYPE=MyISAM;";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not create the layout table. Something must be wrong with MySQL.</h3>');}
echo "..Layout table created.<br>";
$query="CREATE TABLE phpb_other ( accounts int(11) NOT NULL default '0', transactions int(11) NOT NULL default '0', latesttransaction text NOT NULL, intromessage text NOT NULL, nation text NOT NULL, currencysymbol text NOT NULL, topimg text NOT NULL, apassword text NOT NULL ) TYPE=MyISAM;";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not create the information table. Something must be wrong with MySQL.</h3>');}
echo "..Information table created.<br>";
$query="CREATE TABLE phpb_transactions ( id int(11) NOT NULL auto_increment, requester int(11) NOT NULL default '0', acceptor int(11) NOT NULL default '0', direction int(11) NOT NULL default '0', amount double NOT NULL default '0', comment text NOT NULL, status int(11) NOT NULL default '0', timestamp text NOT NULL, PRIMARY KEY (id) ) TYPE=MyISAM;";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not create the transaction table. Something must be wrong with MySQL.</h3>');}
echo "..Transaction table created.<br><br>";

//insert data
$query="INSERT INTO phpb_other VALUES (1, 0, '', '$intromessage', '$nation', '$currencysymbol', 'topimg.png', '$apassword');";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not insert bank data! Something must be wrong with MySQL.</h3>');}
echo "..Bank data inserted.<br>";

$query="INSERT INTO phpb_layout VALUES ('000000', 'FFFFFF', 'FFFFFF', '444444', '15', '888888', '13', 'FF0000', '11', '888888', 'BBBBBB', '11', '000000', 'Tahoma');";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not insert layout data! Something must be wrong with MySQL.</h3>');}
echo "..Layout data inserted.<br>";

$query="INSERT INTO phpb_accounts (`login`,`password`,`name`,`description`,`balance`,`active`,`email`) VALUES ('$login','$password','$name','$description','$balance','1','$email')";
$result=mysql_query($query,$db);
if (!$result)
{die ('<h3>ERROR: Could not insert government account data! Something must be wrong with MySQL.</h3>');}
echo "..Government account data inserted.<br><br>";
?>
<h2>Installation complete!</h2>
The installation was sucessfully completed. You may now go to the <a href="index.php">Index</a>.<br>
Before continuing, delete the files "install.php" and "doinstall.php"!<br>
If you don't delete them, anyone could erase the database!<br>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML> 
