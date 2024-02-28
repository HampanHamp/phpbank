<?php
session_start();
$apassword=$_SESSION['apassword'];
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<HTML>
<HEAD>
<TITLE>PHPBank - Administration - Process layout change</TITLE>
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
echo "<h1>".$other['nation']." - PHPBank: Process layout edit</h1>";
//Check if the password is okay+activity
if ($apassword==$other['apassword'])
{
$bordercolor=$_POST['bordercolor'];
$bgcolor=$_POST['backgroundcolor'];
$insidecolor=$_POST['insidecolor'];
$h1color=$_POST['h1color'];
$h1size=$_POST['h1size'];
$h2color=$_POST['h2color'];
$h2size=$_POST['h2size'];
$h3color=$_POST['h3color'];
$h3size=$_POST['h3size'];
$acolor=$_POST['acolor'];
$ahovercolor=$_POST['ahovercolor'];
$size=$_POST['size'];
$textcolor=$_POST['textcolor'];
$font=$_POST['font'];

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
if (!checkChars($bordercolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The border color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($bgcolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The background color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($insidecolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The inside background color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h1color,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The title text color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h2color,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The important info text color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h3color,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The error text color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($acolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The link text color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($ahovercolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The link text hover color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($textcolor,"1234567890abcdefABCDEF"))
{die ('<h3>ERROR: The text color should be a hexadecimal number (HTML color).</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h1size,"1234567890"))
{die ('<h3>ERROR: The title text size should be an integer.</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h2size,"1234567890"))
{die ('<h3>ERROR: The important info text size should be an integer.</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($h3size,"1234567890"))
{die ('<h3>ERROR: The error text size should be an integer.</h3><a href="admincp.php">Admin CP</a>');}
if (!checkChars($size,"1234567890"))
{die ('<h3>ERROR: The text size should be an integer.</h3><a href="admincp.php">Admin CP</a>');}

$query="UPDATE `phpb_layout` SET `bordercolor`='$bordercolor', `bgcolor`='$bgcolor', `insidecolor`='$insidecolor', `h1color`='$h1color', `h1size`='$h1size', `h2color`='$h2color', `h2size`='$h2size', `h3color`='$h3color', `h3size`='$h3size', `acolor`='$acolor', `ahovercolor`='$ahovercolor', `size`='$size', `textcolor`='$textcolor', `font`='$font'";
$result=mysql_query($query,$db);
if (!$result)
{die("<h3>ERROR: The layout was not edited. Please try again later.</h3>");}
?>
The layout was successfully updated.<br><br>
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
