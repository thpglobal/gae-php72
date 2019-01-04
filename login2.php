<html>
    <head>
        <title>Login2</title>
    </head>
    <body style="margin:3em;">
		<?php
		$checkendpoint = "https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=";
		$checkurl= $checkendpoint.$_POST['idtoken'];
		$v=file_get_contents($checkurl);
		$vp=json_decode($v,true);
		$name=$vp["name"]; $_SESSION["name"]=$name;
		$user=$vp["email"]; $_SESSION["user"]=$user;
		echo("<p>Hello $name. Email: $user</p>\n");
		//	echo "<pre>$v</pre>\n";    
		?>
		<p><a href=/>Click here to continue to home page</a></p>
	</body>
</html>
