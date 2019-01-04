<?php
session_start();
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL & ~E_NOTICE);
$user=$_SESSION["user"];
$name=$_SESSION["name"];
$url=$_SERVER['REQUEST_URI'];
$path=parse_url($url, PHP_URL_PATH);
if($user=='') {
	if($path=="/login2") { include("app/login2.php"); }
	else {include("app/login.php");}
}else{
	if(substr($path,-1)=='/') $path .= "index";
	include("app".$path.".php");
}
