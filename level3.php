<?php
$link = mysql_connect('localhost', 'angry_monster', 'goblins33');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make langstock the current db
$db_selected = mysql_select_db('langstock', $link);
if (!$db_selected) {
    die ('fuuuuuu : ' . mysql_error());
}
set_time_limit(0);
$string = 'a';

function combinations($size) {
    $string = str_repeat('a',$size);
    $endLoopTest = str_repeat('z',$size);
    $endLoopTest++;
    while ($string != $endLoopTest) {
    $eggo = $string++.PHP_EOL;
    echo $eggo;
    echo '<br>';
    $add = "INSERT INTO level1 (`sym`) VALUES ('$eggo')";
mysql_query($add) or die(mysql_error()); 
    }
}
while ($string != 'aaaaa') {
    $eggo = $string++.PHP_EOL;
    echo $eggo;
    echo '<br>';
    $adder = "INSERT INTO level1 (`sym`) VALUES ('$eggo')";
mysql_query($adder) or die(mysql_error()); 
}
?>