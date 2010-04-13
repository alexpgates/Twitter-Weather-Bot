<?php
// V2.1
?>
<?php
set_time_limit('180'); // give the script a little more time to run.
?>
<?php
include('noaa_functions.php'); // xml parsing functions, tinyurl function
include('weatherbot_config.php'); // list of locations
?>
<?php
if(!isset($_GET['t']) || !isset($_GET['z'])){
	die("Invalid Request");
}
?>
<?php
// Time
$time = $_GET['t']; // i.e. 0600 
$zone = $_GET['z']; // i.e. -0600 (as in -0600 UTC)
?>

<?php 
foreach($locations as $key=> $loc){
	
	$p = $loc['p']; // zip
	$u = $loc['u']; // twitter username
	$cf = $loc['cf']; // c or f for temp
	$utc = $loc['utc']; // UTC timezone
	
	if($zone == $utc){

		// create a new curl resource
		$Url = "http://weather.yahooapis.com/forecastrss?p=$p&u=$cf";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $Url);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 10);
		$data = curl_exec($ch); 
		curl_close($ch);
		?>
		<?php
		$arr = xmlize($data);
		echo "<pre>";
		print_r($arr);
		echo "</pre>";
		?>
<?php
			if($time == '0600'){ // 06:00 post (for current timezone)
		
			$day =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['day'];
			$text =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['text'];
			$low =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['low'];
			$high =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['high'];
			$code =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['code'];
			$date = date("D, M d");

			// Unicode breaks SMS!
			//$rain = "☂";
			//$snow = "❄";
			//$cloudy = "☁";
			//$sunny = "☀";

			$comment = "";

				if($code == "5" || $code == "6" || $code == "7" || $code == "8" || $code == "9" || $code == "10" || $code == "18" || $code == "20"){
					$comment = " Drive safely!";
				}

				if($code == "15" || $code == "16" || $code == "23" || $code == "43" || $code == "46"){
					$comment = " Bundle up!";
				}

				if($code == "3" || $code == "4" || $code == "11" || $code == "12" || $code == "35" || $code == "45" || $code == "47"){
					$comment = " Take your umbrella!";
				}

			$message = $date.": ".$text.", High of ".$high.", Low of ".$low.".".$comment;
		
			}

			if($time == '1145'){ // 11:45 post
		
			$temp =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:condition'][0]['@']['temp']; // current temp
			$text =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:condition'][0]['@']['text']; // current condition
			$low =  $arr['rss']['#']['channel'][0]['#']['item'][0]['#']['yweather:forecast'][0]['@']['low'];
			$windchill =  $arr['rss']['#']['channel'][0]['#']['yweather:wind'][0]['@']['chill'];
			$sunset =  $arr['rss']['#']['channel'][0]['#']['yweather:astronomy'][0]['@']['sunset'];
			
			
			// 12/20 - edmonton had warmer windchill (-19) compared to temp (-26) - wind was coming from the south, but I am not sure if that matters. Raw xml showed the same. Yahoo Weather's page showed "feels like" -26. So:
			
			if($temp <= $windchill){
				$feels_like = $temp;
			}else{
				$feels_like = $windchill;
			}
			// ------------------------
			
				
				// Unicode breaks SMS!
				//$rain = "☂";
				//$snow = "❄";
				//$cloudy = "☁";
				//$sunny = "☀";
				
				if($cf == "f"){
					$message = "Currently: ".$text." ".$temp." F (Feels like ".$feels_like.") Sunset: $sunset.";
				}else{
					$message = "Currently: ".$text." ".$temp." C (Feels like ".$feels_like.") Sunset: $sunset.";
				}
			}


		
			echo $u.": ".$message.'<br />'; // comment/uncomment for testing
		
		
		
			// Update the twitterz!
			 		
			 // Set username and password
			 $username = $u; 
 			 $password = 'PASSWORDHERE'; // This probably shouldn't be the same for each account.
 
 			 // The twitter API address
 			 $url = 'http://twitter.com/statuses/update.xml';
 			 $curl_handle = curl_init();
 			 curl_setopt($curl_handle, CURLOPT_URL, "$url");
 			 curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 8);
 			 curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
 			 curl_setopt($curl_handle, CURLOPT_POST, 1);
 			 curl_setopt($curl_handle, CURLOPT_POSTFIELDS, "status=$message");
 			 curl_setopt($curl_handle, CURLOPT_USERPWD, "$username:$password");
 			 $buffer = curl_exec($curl_handle);
 			 curl_close($curl_handle);
 			 // check for success or failure
 			 if (empty($buffer)) {
 			     echo 'Error updating Twitter!';
 			 } else {
 			     echo 'Success!';
 			 }
		
	}
}