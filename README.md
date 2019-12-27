# gae-php72
How to migrate to GAE Standard Environment from PHP 5.5 to PHP 7.2

The GAE PHP 7.2 Standard Environment forces two major changes:
* No more built-in Google Signin via the login: line in app.yaml
* No more script: redirects - all access starts from a single page, nominally index.php

The purpose of this repository is to make it as easy as possible to make the transition.
1) Create a client id for your current GAE web app at https://cloud.google.com/console - select APIs & Auth- then Credentials - to create a new client id. You will need set parameters in the Consent Screen for the authorized domain and the authorized javascript URI (both to your app domain). The client id is a huge long string.
2) Copy the files into your app root area.
3) Edit login.php to replace the line with "YOUR CLIENT ID" with your clientid.
4) index.php assumes your app files and folders are inside an /app folder - adjust this file to taste if not
5) Anywhere you have "include" or "require" must be an absolute rather than relative path, so use statements like require_once($_SERVER["DOCUMENT_ROOT"]./includes/thpsecurity.org"]);

NOTE: Many public packages like adminer already depend on a single index file to run, in which case the initial lines of this index file get added to the top of that file.
