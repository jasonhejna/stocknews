<?php
include 'coneczinc.php';

	$nice = mysql_query("SELECT `sym` FROM levelw WHERE `flag` = '1'");
	while($row = mysql_fetch_array($nice)) {
		print_r($row);
	}
?>