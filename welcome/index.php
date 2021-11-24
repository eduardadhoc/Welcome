<?php
session_start();
foreach (@explode("/",$_SERVER["REQUEST_URI"]) as $value) {
$goto[] = strtolower($value);
}
require("assets/includes/connect.php");
require("assets/includes/functions.php");
require("assets/includes/geoplugin.class.php");

//var_dump($goto);
//die;

//geoloc
$geoplugin = new geoPlugin();
$geoplugin->locate();
$ListCountries=get_paises_availables($mysqli);

$pais=strtolower($geoplugin->countryCode);

$enlace=$goto[1];
$long_enlace=strlen($enlace);


if(($enlace!='')&&($long_enlace>2)&&($enlace!='welcome')&&($enlace!='international')){
	
	include('../index.php');
	
}elseif((isset($_COOKIE['user_country_language'])&&($_COOKIE['user_country_language']!='/'))){

	if($_SERVER['REQUEST_URI']=="/"){
		include('../index.php');		
	}else{		
		header('Location: '.$siteURL.$_COOKIE['user_country_language'].'');	
	}
					
}elseif((isset($_COOKIE['user_country_language'])&&($_COOKIE['user_country_language']=='/'))){
	
	include('../index.php');

}

# ULL! Veure https://ingent.network/issues/8365
#
# $ListCountries inclou ''
#  [0] =>
#  [1] => es
#  [2] => fr
#  [3] => uk
#  [4] => cy
#  [5] => it
#  [6] => de
#  [7] => be
#  [8] => nl
#  [9] => and
#  [10] => se
#
# quan falla Geoplugin $pais és ''
# evitar fer la redicció a 'Location: //'

elseif((!isset($_COOKIE['iswelcome']))&&($pais!='')&&(in_array($pais, $ListCountries)) ){
	
	if(in_array(strtolower($pais), $ListCountries))
	{
		if((strtolower($pais)=='es')&&($geoplugin->region=='Catalonia'))
		{
			header('Location: '.$siteURL.strtolower($pais).'/ca/');
		}else{
			header('Location: '.$siteURL.strtolower($pais).'/');
		}
	}
	
}else{


?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>B2B Router, online electronic invoicing service</title>
	<link rel="apple-touch-icon" sizes="57x57" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-57x57.png?v=2">
	<link rel="apple-touch-icon" sizes="60x60" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-60x60.png?v=2">
	<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-72x72.png?v=2">
	<link rel="apple-touch-icon" sizes="76x76" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-76x76.png?v=2">
	<link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-114x114.png?v=2">
	<link rel="apple-touch-icon" sizes="120x120" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-120x120.png?v=2">
	<link rel="apple-touch-icon" sizes="144x144" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-144x144.png?v=2">
	<link rel="apple-touch-icon" sizes="152x152" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-152x152.png?v=2">
	<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-180x180.png?v=2">
	<link rel="icon" type="image/png" sizes="192x192" href="/wp-content/themes/b2brouter/assets/img/fav/android-icon-192x192.png?v=2">
	<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-32x32.png?v=2">
	<link rel="icon" type="image/png" sizes="96x96" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-96x96.png?v=2">
	<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-16x16.png?v=2">
	<meta name="msapplication-TileImage" content="/wp-content/themes/b2brouter/assets/img/fav/ms-icon-144x144.png?v=2">

	<meta name="robots" content="noindex">

	<link rel="shortcut icon" href="/wp-content/themes/b2brouter/assets/img/b2b-fav/favicon.ico?v=2" />
	<link type="text/css" href="/welcome/assets/css/main.css" rel="stylesheet">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PN3LPJ');</script>
	<!-- End Google Tag Manager -->
</head>

<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PN3LPJ"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
function portalizeJS(country,language){
	var dataString = 'country='+country+"&language="+language;	
	$.ajax({
	type: "POST",
	url: './welcome/portal.php',
	data: dataString,
	success: function(response){
		//alert(response);
		//location.reload(); 
		window.location.replace(response);
	}
});
return false;		
}
</script>	
	<div class="welcome-container">
		<header>
			<a href="/"><img src="/welcome/assets/img/b2b-router.png" alt="B2B Router, online electronic invoicing service" /></a>
		</header>
		<main>
			<h2>Welcome, <span>select your preferences</span></h2>
			<button id="pick">Pick your country</button>
		</main>
		<footer>&copy; 2020 <a href="https://invinet.org/" target="_blank">Invinet Sistemes</a>. All rights reserved.</footer>
	</div>

	<!-- MODAL -->
	<div class="modal-welcome-container">
		<div class="modal-welcome">
			<button><img src="/welcome/assets/img/tancar.svg" alt="Close" /></button>
						
			<?php echo get_countries($siteURL,$mysqli); ?>
						
		</div>
	</div>
	<!-- /MODAL -->

	<!-- SCRIPTS -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
	<script type="text/javascript" src="/welcome/assets/js/scripts.js"></script>

	<!-- SCRIPTS -->
</body>

</html>

<?php
																						 
}
?>
