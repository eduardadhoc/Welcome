<?php

function get_countries($siteURL,$mysqli){
	
	$html= '';
	
	$sPaises = $mysqli->query("select * from b2b_landing_countries order by orden asc");
	if(mysqli_num_rows($sPaises)>0)
	{
		while($rPaises = $sPaises->fetch_assoc()){		
			
			$html.= '<div class="item '.$rPaises['class'].'">
				<div>'.$rPaises['name'].'</div>
				<ul>';
					$sLanguages = $mysqli->query("select * from b2b_landing_languages where id_country=".$rPaises['id_country']." order by id_language asc");
					if(mysqli_num_rows($sLanguages)>0)
					{
						while($rLanguages = $sLanguages->fetch_assoc())
						{	
							if($rPaises['acronym']!=''){
								
								if($rLanguages['acronym']!=''){
									//$html.= '<li><a href="'.$siteURL.$rPaises['acronym'].'/'.$rLanguages['acronym'].'/">'.$rLanguages['name'].'</a></li>';
									$html.= '<li><a href="#"
onClick="return portalizeJS('.$rPaises['id_country'].','.$rLanguages['id_language'].');">'.$rLanguages['name'].'</a></li>';
								}else{
									//$html.= '<li><a href="'.$siteURL.$rPaises['acronym'].'/">'.$rLanguages['name'].'</a></li>';
									$html.= '<li><a href="#"
onClick="return portalizeJS('.$rPaises['id_country'].','.$rLanguages['id_language'].');">'.$rLanguages['name'].'</a></li>';
								}								
								
							}else{
								
									//$html.= '<li><a href="'.$siteURL.'">'.$rLanguages['name'].'</a></li>';
									$html.= '<li><a href="#"
onClick="return portalizeJS('.$rPaises['id_country'].','.$rLanguages['id_language'].');">'.$rLanguages['name'].'</a></li>';
								
								
								
							}
							
							
						}
					}
			$html.= '</ul></div>';
		}
	}
	
	echo $html;
}

function get_paises($mysqli){
	
	$sPaises = $mysqli->query("select * from b2b_landing_countries order by name asc");
	if(mysqli_num_rows($sPaises)>0)
	{
		while($rPaises = $sPaises->fetch_assoc()){		
		echo '<option value="'.$rPaises['id_country'].'">'.$rPaises['name'].'</option><a href="'.$rPaises['url'].'">'.$rPaises['name'].'</a>';
		}
	}
}

function get_languages($mysqli,$id_country){
	
	$sLanguages = $mysqli->query("select * from b2b_landing_languages where id_country=".$id_country." order by id_language asc");
	if(mysqli_num_rows($sLanguages)>0)
	{
		while($rLanguages = $sLanguages->fetch_assoc()){		
		echo '<option value="'.$rLanguages['id_language'].'">'.$rLanguages['name'].'</option><a href="'.$rLanguages['url'].'">'.$rLanguages['name'].'</a>';
		}
	}
} 

function portalize($mysqli,$id_country,$id_language){
	
	$sPortal = $mysqli->query("SELECT c.url as url, c.acronym as country, l.acronym as language FROM b2b_landing_countries as c INNER JOIN b2b_landing_languages as l ON l.id_country=c.id_country AND c.id_country=$id_country AND l.id_language=$id_language");
	if(mysqli_num_rows($sPortal)>0)
	{		
		//while($rPortal = $sPortal->fetch_assoc()){		
		$rPortal = $sPortal->fetch_assoc();
			//header('Location: '.$rPortal['url'].$rPortal['country'].'/'.$rPortal['language'].'/');
		$user_country_language = "user_country_language";
		$user_country_language_value = "".$rPortal['country'].'/'.$rPortal['language']."";
		setcookie($user_country_language, $user_country_language_value, time() + (86400 * 999), "/"); // 86400 = 1 day
		//header('Location: '.$rPortal['url'].$rPortal['country'].'/'.$rPortal['language'].'/');
		echo $rPortal['url'].$rPortal['country'].'/'.$rPortal['language'].'';
		
		//}
		
		//echo "SELECT c.url as url, c.acronym as country, l.acronym as language FROM b2b_landing_countries as c INNER JOIN b2b_landing_languages as l ON l.id_country=c.id_country AND c.id_country=$id_country AND l.id_language=$id_language";
		//print_r($_COOKIE);
	}
} 

function get_paises_availables($mysqli){
	
	$sPaisesAv = $mysqli->query("select acronym from b2b_landing_countries order by id_country asc");
	if(mysqli_num_rows($sPaisesAv)>0)
	{
		$PaisesAv=array();
		while($rPaisesAv = $sPaisesAv->fetch_assoc()){	
			array_push($PaisesAv,$rPaisesAv['acronym']);
		}
		return $PaisesAv;	
	}
}

?>