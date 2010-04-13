<?php
/*
p = zip code or geo code for international
a = state abbreviation used for noaa
c = county (state) used to filter alerts in noaa
u = twitter username for specific account
cf = fahrenheit or celsius
utc = timezone relative to GMT 
noaa = 1 or 0 - bool to check NOAA for alerts
*/

// IMPORTANT: The last line in this array must not have a comma!

$locations = array (
	"minneapolis"  => array("p" => "55402", "a" => "mn", "c" => "MNZ060", "u" => "mspweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"omaha"  => array("p" => "68114", "a" => "ne", "c" => "NEZ052", "u" => "omahaweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"desmoines"  => array("p" => "50309", "a" => "ia", "c" => "IAZ060", "u" => "dsmweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"minneapolis"  => array("p" => "55402", "a" => "mn", "c" => "MNZ060", "u" => "mspweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"ames"  => array("p" => "50010", "a" => "ia", "c" => "IAZ048", "u" => "amesweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"madison"  => array("p" => "53705", "a" => "wi", "c" => "WIZ063", "u" => "madisonweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"cedarrapids"  => array("p" => "52401", "a" => "ia", "c" => "IAZ052", "u" => "crweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"lincoln"  => array("p" => "68508", "a" => "ne", "c" => "NEZ066", "u" => "lincolnweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"nashville"  => array("p" => "37201", "a" => "tn", "c" => "TNZ027", "u" => "musiccityweathr", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"nyc"  => array("p" => "10018", "a" => "ny", "c" => "NYZ072", "u" => "bigappleweather", "cf" => "f", "utc" => "-0500", "noaa" => "1"),
	"chicago"  => array("p" => "60602", "a" => "il", "c" => "ILZ014", "u" => "chi_weather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"LA"  => array("p" => "90071", "a" => "ca", "c" => "CAZ241", "u" => "laxweather", "cf" => "f", "utc" => "-0800", "noaa" => "1"),
	"houston"  => array("p" => "77002", "a" => "tx", "c" => "TXZ163", "u" => "houweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"sanfrancisco"  => array("p" => "94107", "a" => "ca", "c" => "CAZ006", "u" => "sanfran_weather", "cf" => "f", "utc" => "-0800", "noaa" => "1"),
	"phoenix"  => array("p" => "85004", "a" => "az", "c" => "AZZ023", "u" => "phxweather", "cf" => "f", "utc" => "-0700", "noaa" => "1"),
	"detroit"  => array("p" => "48226", "a" => "mi", "c" => "MIZ076", "u" => "motownweather", "cf" => "f", "utc" => "-0500", "noaa" => "1"),
	"dc"  => array("p" => "20006", "a" => "dc", "c" => "DCZ001", "u" => "districtweather", "cf" => "f", "utc" => "-0500", "noaa" => "1"),
	"orlando"  => array("p" => "32803", "a" => "fl", "c" => "FLZ045", "u" => "orlando_weather", "cf" => "f", "utc" => "-0500", "noaa" => "1"),
	"oklahoma_city"  => array("p" => "73102", "a" => "ok", "c" => "OKZ025", "u" => "okcityweather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"tulsa"  => array("p" => "74136", "a" => "ok", "c" => "OKZ060", "u" => "tulsa_weather", "cf" => "f", "utc" => "-0600", "noaa" => "1"),
	"toronto" => array("p" => "CAXX0504", "a" => "xx", "c" => "xx", "u" => "tdotweather", "cf" => "c", "utc" => "-0500", "noaa" => "0"),	
	"edmonton" => array("p" => "CAXX0126", "a" => "xx", "c" => "xx", "u" => "edmweather", "cf" => "c", "utc" => "-0700", "noaa" => "0")
);

// For testing 73102
// 	$locations = array (
// 		"omahatest"  => array("p" => "68114", "a" => "ne", "c" => "NEZ052", "u" => "testymcgee", "cf" => "f", "utc" => "-0600", "noaa" => "1")
// );
?>

<?php

?>