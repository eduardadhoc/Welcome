<?php
session_start();
error_reporting(0);
require("assets/includes/connect.php");
require("assets/includes/functions.php");
require('assets/includes/geoplugin.class.php');
$geoplugin = new geoPlugin();

/* 
Notes:
The default language is English 'en'
supported languages:
de (German)
en (English - default)
es (Spanish)
fr (French)
ja (Japanese)
pt-BR (Portugese, Brazil)
ru (Russian)
zh-CN (Chinese, Zn)

To change the language to e.g. Japanese, use:
$geoplugin->lang = 'ja';
*/


//locate the IP
$geoplugin->locate();


echo "Geolocation results for {$geoplugin->ip}: <br />\n".
	"City: {$geoplugin->city} <br />\n".
	"Region: {$geoplugin->region} <br />\n".
	"Region Code: {$geoplugin->regionCode} <br />\n".
	"Region Name: {$geoplugin->regionName} <br />\n".
	"DMA Code: {$geoplugin->dmaCode} <br />\n".
	"Country Name: {$geoplugin->countryName} <br />\n".
	"Country Code: {$geoplugin->countryCode} <br />\n".
	"In the EU?: {$geoplugin->inEU} <br />\n".
	"EU VAT Rate: {$geoplugin->euVATrate} <br />\n".
	"Latitude: {$geoplugin->latitude} <br />\n".
	"Longitude: {$geoplugin->longitude} <br />\n".
	"Radius of Accuracy (Miles): {$geoplugin->locationAccuracyRadius} <br />\n".
	"Timezone: {$geoplugin->timezone} <br />\n".
	"Currency Code: {$geoplugin->currencyCode} <br />\n".
	"Currency Symbol: {$geoplugin->currencySymbol} <br />\n".
	"Exchange Rate: {$geoplugin->currencyConverter} <br />\n";




if($geoplugin->regionCode=!''){ 

	echo "<br>REGION CODE: ".$geoplugin->countryCode;
	echo "<br><br>LOCATION: ".$siteURL.strtolower($geoplugin->countryCode)."/";
	//header('Location: '.$siteURL.strtolower($geoplugin->countryCode).'/'); 


}


?>