<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Processing registration request</TITLE>
<META NAME="GENERATOR" CONTENT="MAX's HTML Beauty++ ME">
<link rel=stylesheet type=text/css href="style.php">
</HEAD>

<BODY>
<table height=100% width=100% class=centertable><tr><td class=centertable height=100% width=100% valign=middle align=center>
<table cellpadding=15><tr><td align=center>
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
<img src="<?php echo $other['topimg']; ?>"><br>
<?php
echo "<h1>".$other['nation']." - PHPBank: Processing registration</h1>";

$name = strip_tags($_POST['name']);
$login = strip_tags(strtolower($_POST['login']));
$password1 = strip_tags($_POST['password1']);
$password2 = strip_tags($_POST['password2']);
$email = strip_tags($_POST['email']);
$description = strip_tags($_POST['description']);

if (!$name)
{ die("<h3>ERROR: The account name is missing, please hit the back button of your browser and try again.</h3>");}
if (!$login)
{ die("<h3>ERROR: The login ID is missing, please hit the back button of your browser and try again.</h3>");}
if (!$password1)
{ die("<h3>ERROR: One of the passwords is missing, please hit the back button of your browser and try again.</h3>");}
if (!$password2)
{ die("<h3>ERROR: One of the passwords is missing, please hit the back button of your browser and try again.</h3>");}
if (!$email)
{ die("<h3>ERROR: The email is missing, please hit the back button of your browser and try again.</h3>");}

//Checks:
if ($password1!=$password2)
{die("<h3>ERROR: The passwords you typed are different. Please hit the back button of your browser.</h3>");}

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
$query="SELECT * FROM `phpb_accounts`";
$result=mysql_query($query,$db);
while ($checkdoublelogin=mysql_fetch_array($result))
{
if (strtolower($checkdoublelogin['login'])==$login)
{die ("<h3>ERROR: Your login ID is already taken. Please pick another one.</h3>");}
}

if (strlen($description)>100)
{die ('<h3>ERROR: The description is longer than 100 characters. Please limit its length to 100 at max.</h3>');}

if (strlen($name)>30)
{die ('<h3>ERROR: The account name is longer than 30 characters. Please limit its length to 30 at max.</h3>');}

if (strlen($login)>20)
{die ('<h3>ERROR: The login id is longer than 20 characters. Please limit its length to 20 at max.</h3>');}


//insert account information
$password=md5($password1);
$result=mysql_query("INSERT INTO `phpb_accounts` (login,password,name,description,balance,active,email) VALUES ('$login','$password','$name','$description','0','0','$email')",$db);
if (!$result)
{die ("<h3>ERROR: PHPBank failed to store your account information in the database. Please try again later.</h3>");}


$result=mysql_query("SELECT * FROM `phpb_other`",$db);
$nationarray=mysql_fetch_array($result);
$nation=$nationarray['nation'];

$message="Welcome to PHPBank!\n\nYou have registered with the following information:\n\n";
$message=$message."Account Name: $name\n";
$message=$message."Login Id: $name\n";
$message=$message."Password: $password2\n";
$message=$message."Description: $description\n";
$message=$message."Email: $email\n\n";
$message=$message."Your account will now have to be activated by the admin. You will receive notification when this has happened. You can then start using your account!\n\n";
$message=$message."Yours,\n\nPHPBank & $nation";

mail ($email, "New PHPBank account in $nation", $message);

?>
Your Registration was successful! You will receive an email with further details.<br><br>
<a href="index.php">Index</a>
</td></tr></table>
</td></tr></table>
</BODY>
</HTML>
