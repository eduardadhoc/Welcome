<?php
session_start();
error_reporting(0);
require("assets/includes/connect.php");
require("assets/includes/functions.php");
if((!isset($_COOKIE['user_country_language'])||($_COOKIE['user_country_language']==''))){
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>B2B Router, online electronic invoicing service</title>
	<link rel="apple-touch-icon" sizes="57x57" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/wp-content/themes/b2brouter/assets/img/fav/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/wp-content/themes/b2brouter/assets/img/fav/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/wp-content/themes/b2brouter/assets/img/fav/favicon-16x16.png">
	<meta name="msapplication-TileImage" content="/wp-content/themes/b2brouter/assets/img/fav/ms-icon-144x144.png">
	<link type="text/css" href="/welcome/assets/css/main.css" rel="stylesheet">

</head>

<body>
<script>
function portalizeJS(country,language){
	var dataString = 'country='+country+"&language="+language;	
	$.ajax({
	type: "POST",
	url: './portal.php',
	data: dataString,
	success: function(response) { location.reload(); }
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
		<footer>&copy; 2019 <a href="http://invinet.org/" target="_blank">Invinet Sistemes</a>. All rights reserved.</footer>
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
																						 
}else{
	
	if((isset($_COOKIE['user_country_language']))&&($_COOKIE['user_country_language']!='/')){
		header('Location: '.$siteURL.$_COOKIE['user_country_language'].'');
	}else{
		//echo "hey";
		//include('../index.php');
		header('Location: '.$siteURL.'');		
	}
	//die;
}
?>
