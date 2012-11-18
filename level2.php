<?php
//el database
$link = mysql_connect('localhost', 'angry_monster', 'goblins33');
if (!$link) {
    die('Not connected : ' . mysql_error());
}

// make langstock the current db
$db_selected = mysql_select_db('langstock', $link);
if (!$db_selected) {
    die ('fuuuuuu : ' . mysql_error());
}

// Create a stream
$opts = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n"
  )
);
$loop=0;
//almost infinite loop
while ($loop <= 1){
  //set no max limit on execution time
  set_time_limit(0);
$context = stream_context_create($opts);
	$symbols = mysql_query("SELECT `symbol` FROM symbols");
	while($row = mysql_fetch_array($symbols)) {
$insertsym = 'http://feeds.finance.yahoo.com/rss/2.0/headline?s='.$row['symbol'].'&region=US&lang=en-US';
// Open the file using the HTTP headers set above
$file = file_get_contents($insertsym, false, $context);
//echo $file;
//loop for each term
$lp = 0;
while ($lp <= 2) {
$i=0;
if ($lp == 0){
  preg_match_all('~split(.*?)GMT~',$file,$urldata);
  }
if ($lp == 1){
  preg_match_all('~outperform(.*?)GMT~',$file,$urldata);
  }
if ($lp == 2){
  preg_match_all('~overperform(.*?)GMT~',$file,$urldata);
  }
foreach ($urldata as $key => $value) {
foreach ($value as $ree => $bar) {

	$test = substr($bar, -3, 3);
if ($test != "GMT") {
	$bar = $bar . "GMT";
}
$cool = substr($bar, -29);
//echo $cool . '<br>';
$hour = substr($cool, -12, 2);

$minute = substr($cool, -9, 2);

$second = substr($cool, -6, 2);
$second = (int)$second;
$month = substr($cool, -21, 3);
if ($month == "Jan"){$gmonth=(int)1;}
if ($month == "Feb"){$gmonth=(int)2;}
if ($month == "Mar"){$gmonth=(int)2;}
if ($month == "Apr"){$gmonth=(int)4;}
if ($month == "May"){$gmonth=(int)5;}
if ($month == "Jun"){$gmonth=(int)6;}
if ($month == "Jul"){$gmonth=(int)7;}
if ($month == "Aug"){$gmonth=(int)8;}
if ($month == "Sep"){$gmonth=(int)9;}
if ($month == "Oct"){$gmonth=(int)10;}
if ($month == "Nov"){$gmonth=(int)11;}
if ($month == "Dec"){$gmonth=(int)12;}

$day = substr($cool, -24, 2);
$day = (int)$day;
$year = substr($cool, -17, 4);
$year = (int)$year;
$unixcool = mktime($hour,$minute,$second,$gmonth,$day,$year);
$unixcool = $unixcool + 7200;

//echo $unixcool . '<br>';
// find the first news article
//create that arr since we are in foreach
$arr[$i] = $unixcool;
/*$arr = array(
  $i => $unixcool,
  );*/
$i++;
}} //end foreachs
//print_r($arr);
if ($i == 0){
$minarr = 0;
}
else {
  $newscount = array_count_values($arr);
  $minarr =  min($arr);
}
//else {$minarr = $unixcool;}
//echo $minarr.'<br>';
$now = date_default_timezone_set('Etc/GMT+12'); 
//echo $now. '<br>';
$bnow = mktime($now);
//39625 is now, this is slow by 3 hours
$bnow = $bnow + 29625;
//$cnow = $bnow + 
//echo $bnow. '<br>';


if ($minarr >= $bnow && $newscount <= 4){
$searchsymbol = $row['symbol'];

mysql_query("UPDATE symbols SET flag=1 WHERE symbol='$searchsymbol'");

}
echo '<br><br>';
$lp++;
}
} //end while
$loop++;
}
?>