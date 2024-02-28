<?php
//connect
require "config.php";
if ($datpass=="")
{$db = mysql_connect($dathost, $datusr);}
else
{$db = mysql_connect($dathost, $datusr, $datpass);}
mysql_select_db($datname,$db);

//Get Layout Information
$query="SELECT * FROM `phpb_layout`";
$result=mysql_query($query,$db);
$layout=mysql_fetch_array($result);
?>
<style>

<!-- 
body { background-color: <?php echo "#".$layout['bgcolor']; ?>; color: <?php echo "#".$layout['textcolor']; ?>; font-size: <?php echo $layout['size']; ?>px; font-family: "<?php echo $layout['font']; ?>"; }

table { background-color: <?php echo "#".$layout['bordercolor']; ?>; }

.centertable { background-color: <?php echo "#".$layout['bgcolor']; ?>; }

td { background-color: <?php echo "#".$layout['insidecolor']; ?>; font-size: <?php echo $layout['size']; ?>px; font-family: "<?php echo $layout['font']; ?>"; color: <?php echo "#".$layout['textcolor']; ?>; }

i { font-size: <?php echo $layout['size']+1; ?>px; font-style : italic; font-family: "<?php echo $layout['font']; ?>"; }

a { font-weight:bold; text-decoration: none; color: <?php echo "#".$layout['acolor']; ?>; }

a:hover { font-weight:bold; text-decoration: none; color: <?php echo "#".$layout['ahovercolor']; ?>; }

h1 { color: <?php echo "#".$layout['h1color']; ?>; font-size: <?php echo $layout['h1size']; ?>px; font-weight:bold; }

h2 { color: <?php echo "#".$layout['h2color']; ?>; font-size: <?php echo $layout['h2size']; ?>px; font-weight:bold; }

h3 { color: <?php echo "#".$layout['h3color']; ?>; font-size: <?php echo $layout['h3size']; ?>px; font-weight:bold; }

--> 
</style>
