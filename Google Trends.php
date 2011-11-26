<?php

$date = 2;
$month = 9;
$year = 2011;

function dateDiff($start, $end) 
{
 	$start_ts = strtotime($start);
  	$end_ts = strtotime($end);
  	$diff = $end_ts - $start_ts;
  	return round($diff / 86400);
}

for($i = 0; $i < dateDiff("2007-05-15", "2011-09-02"); $i++)
	write_to_file();

function write_to_file()
{
	$fp = fopen('Blank Google Words.txt', 'a');
	fwrite($fp, get_google_trends());
	fclose($fp);
}
function get_google_trends()
{	
	global $month, $date, $year;

	if($date == 0)
	{
		$month--;
		if($month == 0)
		{
			$month = 12;
			$year--;
		}
		
		if($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
			$date = 31;
		else if($month == 2)
			$date = 28;
		else
			$date = 30;
	}
 if (!function_exists('curl_init')) return FALSE;

	$url = "http://www.google.com/trends/hottrends?sa=X&date=" . $year . "-" . $month . "-" . $date;
	
  $options = array(
    CURLOPT_RETURNTRANSFER => true,     
    CURLOPT_HEADER         => false,    
    CURLOPT_FOLLOWLOCATION => true,     
    CURLOPT_ENCODING       => "",       
    CURLOPT_USERAGENT      => "Taboo Card Spider", 
    CURLOPT_AUTOREFERER    => true,     
    CURLOPT_CONNECTTIMEOUT => 30,      
    CURLOPT_TIMEOUT        => 30,      
    CURLOPT_MAXREDIRS      => 3,       
  );

  $ch = curl_init($url);
  curl_setopt_array($ch, $options);
  $content = curl_exec($ch);
  $err = curl_errno($ch);
  $errmsg = curl_error($ch);
  $header = curl_getinfo($ch);
  curl_close($ch);

	$item2 = "";
	if (preg_match_all('/sa=X">.*<\/a>/', $content, $matches)) 
	{
		foreach($matches as $set)
		{
			foreach($set as $item)
			{
				$item2 = $item2 . "\n" . $item;
				$item2 = str_replace('</a>', '', $item2);
	   			$item2 = str_replace('sa=X">', '', $item2);
			}
		}
  	}
	
	$date--;
  	return $item2 . "\n";}
?>