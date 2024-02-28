<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Processing account details update</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Processing account details update</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{
$name=strip_tags($_POST['name']);
$email=strip_tags($_POST['email']);
$description=strip_tags($_POST['description']);
$password1=strip_tags($_POST['password1']);
$password2=strip_tags($_POST['password2']);

if (strlen($description)>100)
{die ('<h3>ERROR: The description is longer than 100 characters. Please limit its length to 100 at max.</h3><a href="details.php">Edit account details</a>');}

if (strlen($name)>30)
{die ('<h3>ERROR: The account name is longer than 30 characters. Please limit its length to 30 at max.</h3><a href="details.php">Edit account details</a>');}


if (!$name)
{ die("<h3>ERROR: The account name is missing.</h3><a href='details.php'>Edit account details</a>");}
if (!$email)
{ die("<h3>ERROR: The email is missing.</h3><a href='details.php'>Edit account details</a>");}

 $query="UPDATE `phpb_accounts` SET `name`='$name',`email`='$email',`description`='$description' WHERE `id`='$accountid'";
   $result=mysql_query($query,$db);
   if (!$result)
   {die ('<h3>ERROR: There is something wrong with the database: Your details were not updated. Please try again later.</h3><a href="details.php">Edit account details</a>');}

if ($password1)
{
 if ($password1!=$password2)
 {die ('<h3>ERROR: The passwords you entered are different. All other changes have been stored.</h3><a href="details.php">Edit account details</a>');}
 $md5pass=md5($password1);
 $query="UPDATE `phpb_accounts` SET `password`='$md5pass' WHERE `id`='$accountid'";
   $result=mysql_query($query,$db);
   if (!$result)
   {die ('<h3>ERROR: The new passwords did not get stored. Please try again later. All other changes have been stored.</h3><a href="details.php">Edit account details</a>');}
echo 'Password updated. You will have to log out and log in again with your new password, else you will probably receive a "wrong password" error.<br>';
}

?>
<h2>Details changed.</h2>
<a href="usercp.php">User CP</a>


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
