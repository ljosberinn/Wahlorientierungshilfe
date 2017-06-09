<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'landing_page.php' );
}

include( 'anbindung.php' );

// Themenmenge via DB zählen
$themenmenge = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `themenuebersicht`" ) );

$themenmenge_hoch_parteienanzahl = pow( $themenmenge, 6 );

$lotto = round( 139838160 / $themenmenge_hoch_parteienanzahl, 0 );

?>

<div class="middle-top">

	<svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
		<path d="M8 5v14l11-7z"/>
		<path d="M0 0h24v24H0z" fill="none"/>
	</svg>

	<span class="font-medium os-sb" onclick="start('<?php echo $_SESSION['themenreihenfolge']; ?>');">Fragebogen starten</span>

</div>


<div class="middle-left">

	<p class="font-medium os-sb">Was ist das?</p>
	<p class="font-small">Ein <a href="https://xkcd.com/927/" title="XKCD Comic zum Thema Standards" target="_blank">weiterer</a> Wahlomat.</p>

	<p class="font-medium os-sb">Warum?</p>
	<p class="font-small">Der <a href="http://www.bpb.de/politik/wahlen/wahl-o-mat/" title="Wahl-O-Mat" target="_blank">Wahlomat der Bundeszentrale für politische Bildung</a> ist weder <a href="https://fragdenstaat.de/anfrage/quellcode-des-wahl-o-mat/" title="Anfrage an die Bundeszentrale für politische Bildung" target="_blank">codetransparent</a>, noch ist die Fragenauswahl in irgendeinerweise <a href="https://www.wahl-o-mat.de/bundestagswahl2013/popup_impressum.php" title="Impressum des Wahl-O-Mats" target="_blank">überprüf- oder nachvollziehbar</a>. Eine nicht direkt auf den Wahlprogrammen basierende Meinungsbildung ohne Quelleneinsicht halte ich somit für leicht manipulierbar.<br />
	Ein staatliches Angebot sollte diese Anforderungen jedoch erfüllen. Dadurch eignet sich diese Wahlorientierungshilfe nicht nur für Erst- oder Zweitwähler, sondern auch für Wähler die dazu tendieren, immer wieder dieselbe Partei zu wählen, ungeachtet der möglicherweise geänderten Inhalte.</p>

	<p class="font-medium os-sb">Was erwartet mich?</p>
	<p class="font-small">Nach einem Klick auf Start werden Ihnen in zufälliger Reihenfolge anonymisierte Auszüge aller Parteien mit Einzugschance in den kommenden Bundestag und aller Parteien, die in den letzten 4 Bundestagen vertreten waren, ausgenommen jenen, die sich seitdem aufgelöst haben, vorgestellt.<br />
	Diese Zitate können teilweise sehr lang ausfallen. Bitte nehmen Sie sich hierfür die Zeit!<br />
	Es stehen <b><?php echo $themenmenge; ?></b> verschiedene Themen zur Auswahl. Aus Gründen der Unvoreingenommenheit werden diese hier nicht aufgezählt.<br />
	<br />Die Reihenfolge der Zitate ist ebenso zufällig um ein ggf. entstehendes Muster zu vermeiden. Jeder Durchgang ist quasi einzigartig, die Wahrscheinlichkeit exakt dieselbe Reihenfolge nochmals auszuwürfeln ist 1: <?php echo $themenmenge_hoch_parteienanzahl; ?>, was in etwa der <?php echo $lotto; ?>-fachen Wahrscheinlichkeit entspricht, den sprichwörtlichen <i><a href="https://de.wikipedia.org/wiki/Lotto#Regelungen_seit_4._Mai_2013" title="Lottochancen lt. Wikipedia" target="_blank">6er im Lotto</a></i> zu haben.</p>
	
</div>

<div class="middle-right">

	<p class="font-medium os-sb">Theorie</p>
	<p class="font-small">Der Mensch ist emotionsgesteuert, weshalb jedes nicht wertfreie Wort zu einem Thema die Meinung des Lesers beeinflusst. Ganz nach dem Motto <i>steter Tropfen höhlt den Stein</i> wurde Einfluss genommen, ob bewusst oder unbewusst, absichtlich oder unabsichtlich. Deshalb wäre es interessant zu sehen, ob eine Wahlempfehlung, die ausschließlich aus Wahlprogrammzitaten, also nahezu juristisch formulierten Texten, ohne die Verbindung zur jeweiligen Partei unerwartete Ergebnisse mit sich bringt. Dass nicht unbedingt das, was in Wahlprogrammen angekündigt wird, auch umgesetzt wird, ist dem Autor natürlich bewusst.</p>

	<p class="font-medium os-sb">Technisches<a href="https://github.com/ljosberinn/Wahlorientierungshilfe" target="_blank" title="Github Quellcode"><svg style="fill: #181717; height: 24px;" viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="1.414"><path d="M8 0C3.58 0 0 3.582 0 8c0 3.535 2.292 6.533 5.47 7.59.4.075.547-.172.547-.385 0-.19-.007-.693-.01-1.36-2.226.483-2.695-1.073-2.695-1.073-.364-.924-.89-1.17-.89-1.17-.725-.496.056-.486.056-.486.803.056 1.225.824 1.225.824.714 1.223 1.873.87 2.33.665.072-.517.278-.87.507-1.07-1.777-.2-3.644-.888-3.644-3.953 0-.873.31-1.587.823-2.147-.09-.202-.36-1.015.07-2.117 0 0 .67-.215 2.2.82.64-.178 1.32-.266 2-.27.68.004 1.36.092 2 .27 1.52-1.035 2.19-.82 2.19-.82.43 1.102.16 1.915.08 2.117.51.56.82 1.274.82 2.147 0 3.073-1.87 3.75-3.65 3.947.28.24.54.73.54 1.48 0 1.07-.01 1.93-.01 2.19 0 .21.14.46.55.38C13.71 14.53 16 11.53 16 8c0-4.418-3.582-8-8-8"></path></svg></a>
	</p>

	<p class="font-small">		
		<span class="os-sb">Frontend</span> HTML5, CSS, Javascript<br />
		<span class="os-sb">Backend</span> MySQLi, PHP7<br />
		<span class="os-sb">Arbeitszeit</span> 2 Monate Konzepterarbeitung | ~ 2 Wochen Realisierungszeit | 7 Tage Testphase<br />
		<br />
		<span class="os-sb">Alle PHP-Dateien<sup class="font-tiny">mit Ausnahme der Datenbankverbindung</sup> können via /?sourcecode direkt eingesehen werden!</span><br />
	</p>

</div>