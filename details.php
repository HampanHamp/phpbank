<?php
session_start();
$login=$_SESSION['login'];
$password=$_SESSION['password'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Edit account details</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Edit account details</h1>";

//Check if the password is okay+activity
if ($password==$account['password'])
{
if ($account['active'])
{

?>

<form method=POST name=accountdetails action="processdetails.php">
Account Name:<br>
<input type=text name="name" value="<?php echo $account['name'] ?>"><br><br>
New Password:<br>
<input type=password name="password1" value=""><br><br>
New Password again:<br>
<input type=password name="password2" value=""><br><br>
Description:<br>
<textarea name=description><?php echo $account['description'] ?></textarea><br><br>
Email:<br>
<input type=text name="email" value="<?php echo $account['email'] ?>"><br><br>

<input type=submit value="Change details">
</form><br>
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
