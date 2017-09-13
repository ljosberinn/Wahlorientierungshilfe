<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'index.php' );
	die();
}

if ( $_SERVER[ 'HTTPS' ] != 'on' ) {
	$redirect = 'https://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'REQUEST_URI' ];
	header( 'Location:' . $redirect . '' );
}

session_start();

if ( !isset( $_SESSION[ 'themenreihenfolge' ] ) ) {

	include( 'modules/rng.php' );

}

?>

<!doctype html>
<html lang="de">

<head>
	<meta charset="UTF-8">
	
	<!-- Seitenbeschreibung -->
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-title" content="Neutrale Wahlorientierungshilfe - Bundestagswahl 2017">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="application-name" content="Neutrale Wahlorientierungshilfe - Bundestagswahl 2017">	
	<meta name="description" content="Eine neutrale und transparente Wahlorientierungshilfe, basierend auf anonymisierten Direktzitaten aus allen Wahlprogrammen."/>
	
	<!-- Favicons, generiert mit http://realfavicongenerator.net/ -->
	<link rel="apple-touch-icon" sizes="180x180" href="favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="48x48" href="favicons/favicon-48x48.png">
	<link rel="icon" type="image/png" sizes="32x32" href="favicons/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="favicons/favicon-16x16.png">
	<link rel="manifest" href="favicons/manifest.json">
	<link rel="mask-icon" href="favicons/safari-pinned-tab.svg" color="#4fb0c6">
	<link rel="shortcut icon" href="favicons/favicon.ico">
	<meta name="msapplication-config" content="favicons/browserconfig.xml">
	<meta name="theme-color" content="#ffffff">

	<!-- OpenGraph für Facebook & WhatsApp -->
	<meta property="og:title" content="Neutrale Wahlorientierungshilfe - Bundestagswahl 2017"/>
	<meta property="og:type" content="website"/>
	<meta property="og:url" content="https://wahl2017.gerritalex.de/">
	<meta property="og:image" content="https://wahl2017.gerritalex.de/sharing.png"/>
	<meta property="og:description" content="Eine neutrale und transparente Wahlorientierungshilfe, basierend auf anonymisierten Direktzitaten aus allen Wahlprogrammen."/>
	<meta property="fb:app_id" content="1384731081617307" />

	<!-- Google+ Seitenbeschreibung -->
	<meta itemprop="name" content="Neutrale Wahlorientierungshilfe - Bundestagswahl 2017">
	<meta itemprop="description" content="Eine neutrale und transparente Wahlorientierungshilfe, basierend auf anonymisierten Direktzitaten aus allen Wahlprogrammen.">
	<meta itemprop="image" content="https://wahl2017.gerritalex.de/sharing.png">

	<!-- Twitter Seitenbeschreibung -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="@wahlorient">
	<meta name="twitter:title" content="Neutrale Wahlorientierungshilfe - Bundestagswahl 2017">
	<meta name="twitter:description" content="Eine neutrale und transparente Wahlorientierungshilfe, basierend auf anonymisierten Direktzitaten aus allen Wahlprogrammen.">
	<meta name="twitter:creator" content="@gerrit_alex">
	<!-- Twitter summary card with large image must be at least 280x150px -->
	<meta name="twitter:image:src" content="https://wahl2017.gerritalex.de/sharing.png">

	<!-- internes CSS -->
	<link rel="stylesheet" href="css/general.css"/>
	<link rel="stylesheet" href="css/jquery-ui.min.css"/>

	<!-- externes CSS -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600|Gentium+Basic:700" rel="stylesheet">

	<!-- Javascript Bibliotheken -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
	<!-- jQueryUI Custom gebaut via https://jqueryui.com/download/#!version=1.12.1&components=111111111111110111111110111111111001101111010111 -->
	<script type="text/javascript" src="js/jquery-ui.min.js"></script>

	<!-- Custom Javascript - eine nicht-minified Version finden Sie unter js/custom.js -->
	<script type="text/javascript" src="js/custom-min.js"></script>

	<!-- derzeitiger Dokumententitel -->
	<title>Neutrale Wahlorientierungshilfe zur Bundestagswahl 2017</title>
	<!-- Facebook, Twitter, Google+, WhatsApp, Messenger & Github SVG Icons von https://simpleicons.org/ - Mail & Feedback Icons von https://material.io/icons/ -->

	<noscript>
			<meta http-equiv="refresh" content="0;url=nojs.php">
	</noscript>
</head>

<body>

	<div class="top">

		<?php

		include( 'modules/header.html' );

		?>

	</div>
	<div class="middle">
		
		<?php

		include( 'modules/landing_page.php' );

		?>

	</div>
	<div class="bottom">

		<?php

		include( 'modules/footer.php' );

		?>

	</div>

	<?php

	if ( !empty( $_SESSION[ 'thema0_antwort' ] ) ) {

		echo '
		<script type="text/javascript">
			start(\'' . $_SESSION[ 'themenreihenfolge' ] . '\');
		</script>';

	}

	?>
	
	<script>
		(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

		ga('create', 'UA-105994384-1', 'auto');
		ga('send', 'pageview');

	</script>

</body>

</html>