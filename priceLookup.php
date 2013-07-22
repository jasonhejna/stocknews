<?php
$sym1 = 'GOOG';
$sym2 = 'MSFT';
$sym3 = 'YHOO';
$sym4 = 'FB';
//http://developer.yahoo.com/yql/console/
//select Bid, Ask, AskRealtime, BidRealtime, DaysRange, DaysRangeRealtime, FiftydayMovingAverage, TwoHundreddayMovingAverage, ChangeFromTwoHundreddayMovingAverage, PercentChangeFromTwoHundreddayMovingAverage, ChangeFromFiftydayMovingAverage, PercentChangeFromFiftydayMovingAverage from yahoo.finance.quotes where symbol in ("YHOO","AAPL","GOOG","MSFT") | sort(field="ChangeRealtime", descending="true")
$yahooAPI = 'http://query.yahooapis.com/v1/public/yql?q=select%20Bid%2C%20Ask%2C%20AskRealtime%2C%20BidRealtime%2C%20DaysRange%2C%20DaysRangeRealtime%2C%20FiftydayMovingAverage%2C%20TwoHundreddayMovingAverage%2C%20ChangeFromTwoHundreddayMovingAverage%2C%20PercentChangeFromTwoHundreddayMovingAverage%2C%20ChangeFromFiftydayMovingAverage%2C%20PercentChangeFromFiftydayMovingAverage%20from%20yahoo.finance.quotes%20where%20symbol%20in%20(%22'.$sym1.'%22%2C%22'.$sym2.'%22%2C%22'.$sym3.'%22%2C%22'.$sym4.'%22)%20%7C%20sort(field%3D%22ChangeRealtime%22%2C%20descending%3D%22true%22)&diagnostics=true&env=http%3A%2F%2Fdatatables.org%2Falltables.env';
$incomingData = file_get_contents($yahooAPI);
<<<<<<< HEAD
if($incomingData === FALSE) {  
	echo "Unable to connect to yahoo apis in priceLookup.php on line 9";
}else{

//echo $incomingData;
$xml = simplexml_load_string($incomingData); 

$two = $xml->results->quote[1]->Bid; 
print_r($two);
 
}
=======


echo $incomingData;


>>>>>>> 0fe0084a961b2f79c3afbe9c6cc09f2961dae40e
?>