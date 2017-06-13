<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'nojs.php' );
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
	<meta property="fb:app_id" content="1384731081617307"/>

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
</head>

<body>

	<div class="top">

		<?php

		include( 'modules/header.html' );

		?>

	</div>
	<div class="middle">

		<div class="middle-top">
			<p class="font-medium">Um diese Seite anzeigen zu können, muss Ihr Browser Javascript unterstützen.<br/> Bitte aktivieren Sie Javascript, gestatten Sie dieser Seite, Javascript auszuführen oder aktualisieren Sie Ihren Browser.<br/>
				<br/>Sollten Sie die Browsererweiterung <a href="https://de.wikipedia.org/wiki/NoScript" title="Wikipedia NoScript">NoScript</a> installiert haben, können Sie dieser Seite temporär Rechte einräumen:<br/>
				<img src="img/noscript.png" alt="noscript.png" title="NoScript temporär deaktivieren Anleitung"/>
				<br/> Es folgen Links zu aktuellen Browsern:<br/>

				<a href="https://www.google.de/chrome/browser/desktop/index.html" title="Google Chrome">Google Chrome</a> - <a href="https://www.mozilla.org/de/firefox/products/" title="Mozilla Firefox">Mozilla Firefox</a> - <a href="https://www.apple.com/de/safari/" title="Safari">Safari</a><br/>
				<br/> Sollten Sie dennoch Sicherheitsbedenken haben, steht es Ihnen frei sich den <a href="https://github.com/ljosberinn/Wahlorientierungshilfe" title="Github Repository">Quelltext auf Github</a> anzusehen.
			</p>
		</div>

	</div>
	<div class="bottom">

		<?php

		include( 'modules/footer.php' );

		?>

	</div>

</body>

</html>