<?php
//echo "Ok";
$file = './tmp/stat.txt';
$fp = @fopen($file, "a+");
$stat = urldecode($_GET['name']);
fwrite($fp, $stat);
fclose($fp);
?>