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
<meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />

  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="apple-touch-icon" sizes="180x180" href="/fav/apple-touch-icon.png?v=3">
  <link rel="icon" type="image/png" sizes="32x32" href="/fav/favicon-32x32.png?v=3">
  <link rel="icon" type="image/png" sizes="16x16" href="/fav/favicon-16x16.png?v=3">
  <link rel="manifest" href="/fav/site.webmanifest?v=3">
  <link rel="mask-icon" href="/fav/safari-pinned-tab.svg?v=3" color="#5bbad5">
  <link rel="shortcut icon" href="favicon.ico?v=4">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="/fav/mstile-144x144.png?v=3">
  <meta name="msapplication-config" content="/fav/browserconfig.xml?v=3">
  <meta name="theme-color" content="#ffffff">

	<meta name="robots" content="noindex">

	<link rel="shortcut icon" href="/fav/favicon.ico?v=3" />
	<link type="text/css" href="/welcome/style.css" rel="stylesheet">
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PN3LPJ');</script>
	<!-- End Google Tag Manager -->
</head>

<body class="has-background-blue has-text-white" itemscope="itemscope" itemtype="https://schema.org/Organization">
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

<!-- WRAPPER -->
<div class="wrapper">

<!-- HEADER -->
<header>
  <div class="logo">
    <svg fill="none" viewBox="0 0 165 30"><path fill="#fff" d="M38.9688 20.9759h-.0631l-.1564 1.5h-1.0618V2.2109h1.2813v4.362l-.0631 2.931c1.5309-1.278 3.3747-2.37 5.1884-2.37 4.0305 0 6.0307 3.024 6.0307 7.638 0 5.082-3.092 8.073-6.6172 8.073-1.4437 0-3.101-.747-4.5388-1.869Zm9.7814-6.204c0-3.708-1.3114-6.483-4.8426-6.483-1.5039 0-3.1582.873-4.9388 2.493v8.976c1.6573 1.404 3.3447 1.935 4.4696 1.935 3.092.003 5.3118-2.838 5.3118-6.921ZM66.8145 20.9759h-.0631l-.1564 1.5h-1.0618V2.2109h1.2813v4.362l-.0631 2.931c1.5309-1.278 3.3747-2.37 5.1884-2.37 4.0305 0 6.0307 3.024 6.0307 7.638 0 5.082-3.0921 8.073-6.6172 8.073-1.4317 0-3.089-.747-4.5388-1.869Zm9.7814-6.204c0-3.708-1.3114-6.483-4.8426-6.483-1.5039 0-3.1582.873-4.9388 2.493v8.976c1.6573 1.404 3.3447 1.935 4.4696 1.935 3.1041.003 5.3238-2.838 5.3238-6.921h-.012ZM80.9902 6.996h3.9373l.3458 2.679h.1234c1.1249-2.1 2.8454-3.054 4.4064-3.054.9023 0 1.4377.093 1.8769.3l-.9024 4.0831a6.1444 6.1444 0 0 0-1.5941-.189c-1.155 0-2.5627.75-3.3748 2.808v8.85h-4.8125l-.006-15.477ZM92.1777 14.7094c0-5.142 3.6575-8.1 7.5947-8.1 3.9376 0 7.6246 2.961 7.6246 8.1 0 5.139-3.657 8.136-7.6246 8.136-3.9673 0-7.5947-2.991-7.5947-8.136Zm10.2503 0c0-2.556-.845-4.239-2.6556-4.239-1.8107 0-2.6559 1.683-2.6559 4.239s.8422 4.239 2.6559 4.239c1.8136 0 2.6556-1.65 2.6556-4.239ZM109.525 16.5961v-9.6h4.843v8.976c0 2.151.562 2.772 1.805 2.772 1.094 0 1.75-.435 2.592-1.587V6.9961h4.846v15.489h-3.934l-.346-2.118h-.123c-1.282 1.527-2.753 2.493-4.846 2.493-3.405-.015-4.837-2.415-4.837-6.264ZM127.928 16.7382v-6h-2.106v-3.603l2.376-.153.563-4.74h4v4.755h3.655v3.771h-3.643v5.922c0 1.746.812 2.4 1.967 2.4.489.0107.975-.0634 1.438-.219l.752 3.366a9.8305 9.8305 0 0 1-3.534.624c-3.874-.015-5.468-2.478-5.468-6.123ZM137.77 14.7094c0-5.019 3.624-8.1 7.345-8.1 4.511 0 6.686 3.24 6.686 7.449.005.7113-.058 1.4214-.187 2.121h-9.155c.436 2.1 1.904 3 3.874 3a6.7506 6.7506 0 0 0 3.344-.966l1.561 2.898a10.0167 10.0167 0 0 1-5.594 1.746c-4.437-.012-7.874-2.961-7.874-8.148Zm9.907-1.776c0-1.527-.689-2.682-2.439-2.682-1.375 0-2.53.873-2.842 2.682h5.281ZM154.086 6.996h3.937l.343 2.679h.123c1.125-2.1 2.846-3.054 4.407-3.054.902 0 1.438.093 1.877.3l-.903 4.0831a6.1724 6.1724 0 0 0-1.594-.189c-1.158 0-2.562.75-3.378 2.808v8.85h-4.812V6.9961ZM51.9242 21.6951c5.6908-5.1 8.5241-7.983 8.5241-10.656 0-1.941-1.158-3.399-3.7447-3.399-1.6122 0-3.074.882-4.0786 2.004l-.791-.729c1.3385-1.425 2.8905-2.337 4.9298-2.337 3.104 0 4.9628 1.761 4.9628 4.401 0 3.096-3.1371 6.042-7.9135 10.5.9024-.06 1.916-.12 3.1642-.12h5.5705v1.122H51.9242v-.786ZM7.3223.4105a.395.395 0 0 1 .076-.2316.3972.3972 0 0 1 .1978-.1433.471.471 0 0 1 .5237.114l5.7753 6.4119H7.3223V.4105ZM1.243 7.4928h12.5527l-6.4584 6.328-.1325.1289a3.4175 3.4175 0 0 0-.3882.5039 3.3544 3.3544 0 0 0-.4845 1.3375 3.0305 3.0305 0 0 0-.0331.4379v6.265H1.24a1.2063 1.2063 0 0 1-.861-.3247 1.1978 1.1978 0 0 1-.379-.836V8.6535a1.196 1.196 0 0 1 .1064-.4562 1.1996 1.1996 0 0 1 .2737-.3809 1.2046 1.2046 0 0 1 .8628-.3236Z"/><path fill="#fff" d="M7.3852 15.7016c.092-.3869.2816-.744.5507-1.0377l6.5939-6.4569v14.2844c-.2137.2279-6.2358 6.9787-6.621 7.3836a.3405.3405 0 0 1-.6019-.186V16.9792a6.0352 6.0352 0 0 1 .0783-1.2776ZM22.773.4099a.3953.3953 0 0 0-.0774-.2323.3972.3972 0 0 0-.1995-.1426.474.474 0 0 0-.5237.114l-5.7693 6.4119h6.5759l-.006-6.151ZM28.8442 7.4928H16.3125l6.4615 6.328.1294.1289a3.42 3.42 0 0 1 .3882.5039c.2576.4055.4239.8618.4876 1.3375.0201.1452.0311.2914.0331.4379v6.265h5.0319a1.2067 1.2067 0 0 0 .8629-.3236 1.1995 1.1995 0 0 0 .3801-.8371V8.6535a1.1973 1.1973 0 0 0-.3801-.837 1.2047 1.2047 0 0 0-.8629-.3237Z"/><path fill="#fff" d="M22.7061 15.7016a2.3374 2.3374 0 0 0-.5508-1.0377L15.5645 8.207v14.2844c.2106.2279 6.2357 6.9787 6.6209 7.3836a.3446.3446 0 0 0 .3624.1044.3442.3442 0 0 0 .1634-.1094.341.341 0 0 0 .0761-.181V16.9792a6.0348 6.0348 0 0 0-.0812-1.2776Z"/></svg>
  </div>
  <h1 class="jumbo-title">Welcome,<br> please select your preferences.</h1>
</header>
<!-- /HEADER -->

<!-- MAIN -->
<main>
<ul class="cols-list-4">
<?php echo get_countries($siteURL,$mysqli); ?>
</ul>
</main>
<!-- /MAIN -->

</div>
<!-- /WRAPPER -->

	<!-- SCRIPTS -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js' integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==' crossorigin='anonymous'></script>

	<script type="text/javascript" src="/welcome/assets/js/bundle.js"></script>
	<!-- SCRIPTS -->
</body>

</html>

<?php

}
?>
