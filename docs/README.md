# Migrating to GAE PHP 7.2

How to migrate to GAE Standard Environment from PHP 5.5 to PHP 7.2

The GAE PHP 7.2 Standard Environment forces major changes:
* No more built-in Google Signin via the login: line in app.yaml
* No more script: redirects - all access starts from a single page, nominally index.php
* No more easy access to cloud storage and the mail api.

See https://cloud.google.com/appengine/docs/standard/php7/php-differences for all the problems!

The purpose of this repository is to make it as easy as possible to make the transition.
1. Create a client id for your current GAE web app at https://cloud.google.com/console - select APIs & Auth- then Credentials - to create a new client id. You will need set parameters in the Consent Screen for the authorized domain and the authorized javascript URI (both to your app domain). The client id is a huge long string. Store it in $client_id in your root index.php (which is only used for redirection.
2. Create a super-simple redirector. Here is one.
`<?php
`session_start();
`ini_set('display_errors',1);
`ini_set('display_startup_errors',1);
`error_reporting(E_ALL & ~E_NOTICE);
`$user=$_SESSION["user"];
`$name=$_SESSION["name"];
`$url=$_SERVER['REQUEST_URI'];
`$path=parse_url($url, PHP_URL_PATH);
$client_id="the long string that google gives you";
`if($user=='') {
`	if($path=="/login2") { include("app/login2.php"); }
`	else {include("app/login.php");}
`}else{
`	if(substr($path,-1)=='/') $path .= "index";
`	include("app".$path.".php");
`}
3. The above redirector assumes login.php and login2.php are in your app folder. If you are using our thpclasses for your app, there are copies there that you can simply reference.
4. Anywhere you have "include" or "require" must be an absolute rather than relative path, so use statements like require_once($_SERVER["DOCUMENT_ROOT"]./includes/thpsecurity.org"]);
5. If you need to access cloud storage, you need to follow this, and use composer: https://cloud.google.com/appengine/docs/standard/php7/using-cloud-storage
6. If you need to send emails, follow these instructions to use a 3rd party mailer
https://cloud.google.com/appengine/docs/standard/php7/tutorials (there are two free options, I chose mailjet)


## Remove any unneccessary submodules
See https://gist.github.com/myusuf3/7f645819ded92bda6677
