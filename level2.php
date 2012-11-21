<?php
  set_time_limit(0);
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
  $fml=0;
  $limit = 11000;
  $doslim = 12000;
while ($fml <= 3){

$fml++;
$context = stream_context_create($opts);
  $result_bro = mysql_query("SELECT `sym` FROM levelw LIMIT $limit,$doslim");
  while($row = mysql_fetch_array($result_bro)) {
//echo $searchsymbol.'<br>';
    $sheldor = $row['sym'];
    $sheldor = rtrim($sheldor);
    //echo $sheldor;
  //echo $rower;
$strone = "http://feeds.finance.yahoo.com/rss/2.0/headline?s=";
$strtwo = "&amp;";
$strthree = "region=US&lang=en-US";
$insertsym = "{$strone}{$sheldor}{$strtwo}{$strthree}";
//echo $insertsym . '<br>';
//echo $rower;
// Open the file using the HTTP headers set above
$file = file_get_contents($insertsym, false, $context);
/*$sweeti = 0;
preg_match_all('~RSS feed not found~',$file,$sweeti);
if ($sweeti == 0) {*/
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
  preg_match_all('~Clinical Trial(.*?)GMT~',$file,$urldata);
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
//echo $hour . '<br>';
$minute = substr($cool, -9, 2);
//echo $minute . '<br>';
$second = substr($cool, -6, 2);
$second = (int)$second;
//echo $second . '<br>';
$month = substr($cool, -21, 3);
//echo $month . '<br>';
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
//echo $gmonth. '<br>';
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
$now = date_default_timezone_set('GMT'); 
$bnow = mktime($now);
//13.5 hours less than now
$bnow = $bnow - 48600;
//$cnow = $bnow + 
//echo $bnow. '<br>';


if ($minarr > $bnow){

$one = 1;
mysql_query("UPDATE levelw SET flag='$one' WHERE sym='$sheldor'");

}
$lp++;
}

//} //end while
//$loop++;
}
$limit = $limit + 1000;
$doslim = $limit + 2000;
}
echo 'success';
?>