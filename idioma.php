<?php

// Idioma
if(isset($_GET["lang"])){
	$lang = $_GET["lang"];
  	if(!empty($lang)){
  	  $_SESSION["lang"] = $lang;
  	}
}
if(isset($_SESSION['lang'])){
  	$lang = $_SESSION["lang"];
  	require "lang/".$lang.".php";
}else{
	$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	
  	switch ($lang){
    		case "es":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'es';
    	    break;
    	case "en":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'en';
    	    break;
		case "ko":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'ko';
    	    break;
		case "ca":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'ca';
    	    break;
		case "fr":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'fr';
    	    break;
		case "de":
    	    require "lang/".$lang.".php";
			$_SESSION["lang"] = 'de';
    	    break;
    	default:
    	    require "lang/en.php";
			$_SESSION["lang"] = 'en';
    	    break;
	}
}

$idiomasCode = array(
	"es" => "Castellano",
	"en" => "English",
	"ko" => "한국어",
	"ca" => "Català",
	"fr" => "Français",
	"de" => "Deutsch",

);
