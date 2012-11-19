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

?>