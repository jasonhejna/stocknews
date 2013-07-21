<?php
$news = simplexml_load_file('http://www.google.co.uk/finance/company_news?q=NYSE:FB&output=rss');

foreach($news->channel->item as $item) {
	echo strip_tags($item->pubDate) ."<br />";
    echo "<strong>" . $item->title . "</strong><br />";
    echo strip_tags($item->description) ."<br /><br />";
}
?>