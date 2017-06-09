<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'eval.php' );
}

session_start();

if ( isset( $_POST[ 'reihenfolge' ] ) ) {

	include( 'anbindung.php' );

	// Themenmenge via DB zählen
	$themenmenge = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `themenuebersicht`" ) );

	// Themenkonvertierung
	$themen = explode( '.', $_POST[ 'reihenfolge' ] );

	echo '
	<div class="middle-left">
	<p class="font-medium os-sb">Auswertung<sup class="font-small"><a href="https://wahl2017.gerritalex.de" title="Zurück">Zurück</a></sup></p>
	<p class="font-small">Bitte beachten Sie: das Ergebnis ist, wie der Titel der Seite bereits unterstreichen soll, nur eine Orientierungshilfe. Es ersetzt die mündige Selbstbeschäftigung mit derart komplexen Themen nur grundlegend und ist als Anreiz gedacht, sich mit den Wahlprogrammen der Parteien, mit denen Sie die höchste Übereinstimmung haben, selbst auseinanderzusetzen.</p>';

	// Antworten abholen
	$antwort_array = array();
	for ( $i = 0; $i <= ( $themenmenge - 1 ); $i++ ) {
		array_push( $antwort_array, $_SESSION[ 'thema' . $i . '_antwort' ] );
	}

	// Variablen vorbereiten
	// Anzahl Parteien
	$parteienanzahl = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `parteien`" ) );

	for ( $i = 1; $i <= $parteienanzahl; $i++ ) {

		${'partei_' . $i . ''}[ 'counter' ] = 0;
		$buffer = mysqli_fetch_array( mysqli_query( $stream, "SELECT `partei`, `hex` FROM `parteien` WHERE `id` = '" . $i . "'" ) );
		${'partei_' . $i . ''}[ 'partei' ] = $buffer[ 'partei' ];
		${'partei_' . $i . ''}[ 'hex' ] = $buffer[ 'hex' ];
		${'partei_' . $i . ''}[ 'themen' ] = array();

	}

	$i = 0;
	
	// pro Antwort Parteizugehörigkeit abholen
	foreach ( $antwort_array as $antwort ) {

		$themennummer = $themen[ $i ];
		
		$session_antwort = $_SESSION[ 'thema' . ( $themennummer - 1 ) . '_zitat' . ( $antwort - 1 ) . '' ];

		$themenname = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $themennummer . "'" ) );
		$themenname = $themenname[ 'thema' ];
		
		$partei = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `" . $themennummer . "` WHERE `id` = '" . $session_antwort . "'" ) );
		$partei = $partei[ 'id' ];		
		
		// Wert inkrementieren
		// keine Gewichtung
		if(!isset($_SESSION['aufwerten1']) && !isset($_SESSION['aufwerten2']) && !isset($_SESSION['abwerten1']) && !isset($_SESSION['abwerten2'])) {
			
			${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ] + 1;
			array_push(${'partei_' . $partei . ''}[ 'themen' ], $themenname);
			
		}
		// Gewichtung vorhanden
		elseif(isset($_SESSION['aufwerten1']) || isset($_SESSION['aufwerten2']) || isset($_SESSION['abwerten1']) || isset($_SESSION['abwerten2'])) {
						
			if($_SESSION['aufwerten1'] == $themennummer) {
				${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ] + 2;
				array_push(${'partei_' . $partei . ''}[ 'themen' ], '<span class="os-sb" style="color: rgb(79, 176, 198);">' .$themenname. '</span>');
			}
			elseif($_SESSION['aufwerten2'] == $themennummer) {
				${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ] + 2;
				array_push(${'partei_' . $partei . ''}[ 'themen' ], '<span class="os-sb" style="color: rgb(79, 176, 198);">' .$themenname. '</span>');
			}
			elseif($_SESSION['abwerten1'] == $themennummer) {
				${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ];
				array_push(${'partei_' . $partei . ''}[ 'themen' ], '<span style="opacity: 0.25;">' .$themenname. '</span>');
			}
			elseif($_SESSION['abwerten2'] == $themennummer) {
				${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ];
				array_push(${'partei_' . $partei . ''}[ 'themen' ],'<span style="opacity: 0.25;">' .$themenname. '</span>');
			}
			else {
				${'partei_' . $partei . ''}[ 'counter' ] = ${'partei_' . $partei . ''}[ 'counter' ] + 1;
				array_push(${'partei_' . $partei . ''}[ 'themen' ], $themenname);
			}
		}
		
		$i++;

	}
	
	// Ergebnisse numerisch absteigend sortieren
	$partei_array = array( $partei_1, $partei_2, $partei_3, $partei_4, $partei_5, $partei_6 );
	arsort( $partei_array );
	
	// pro Ergebnis prozentuale Gesamtübereinstimmung abholen
	
	// Farbquellen:
	// AfD - https://de.wikipedia.org/wiki/Alternative_f%C3%BCr_Deutschland ("hellblau"); Farbe letzten Endes aus dem Logo manuell entnommen
	// Bündnis 90/Die Grünen - https://www.gruene.de/fileadmin/user_upload/Dokumente/GRUENE_Design_Handbuch_Januar2017.pdf Version Januar 2017 Seite 16
	// CDU/CSU - http://cd.cducsu.de/de/basiselemente/farben.html
	// Die Linke - https://www.die-linke.de/fileadmin/download/erscheinungsbild/umgang_mit_der_marke.pdf Stand 22. Mai 2007 Seite 8
	// FDP - https://www.fdp.de/sites/default/files/uploads/2016/10/19/161018-fdp-gestaltungsrichtlinien-rgb.pdf Stand Oktober 2016 Seite 6
	// SPD - https://www.spd.de/fileadmin/Dokumente/Servicedokumente/corporate_design_manual.pdf Stand 4/2015 Seite 8
	
	$i = 0;
	
	foreach ( $partei_array as $ergebnis ) {

		$prozent = $ergebnis[ 'counter' ] / $themenmenge * 100;
				
		echo '
		<div style="margin-left: 20px; width: calc(100% - 40px); height: 10px; border: 1px solid #' . $ergebnis[ 'hex' ] . ';">
			<div style="width: ' . $prozent . '%; max-width: 100%; height: 10px; background-color: #' . $ergebnis[ 'hex' ] . ';"></div>
		</div>
		<p class="os-sb" style="margin-top: 0px; margin-bottom: 0px;">' . $prozent . '% – ' . $ergebnis[ 'partei' ] . '</p>';		
		
		if(!empty($ergebnis['themen'])) {
			
			// falls mehrere Themen dieser Partei gewählt wurden
			if(isset($ergebnis['themen'][0]) && isset($ergebnis['themen'][1])) {
				
				echo '
				<p style="margin-top: 0px;">
					<span class="os-sb">Themen:</span> ';
			
			}
			elseif(isset($ergebnis['themen'][0]) && !isset($ergebnis['themen'][1])) {
								
				echo '
				<p style="margin-top: 0px;">
					<span class="os-sb">Thema:</span> ';
			}
			
			// https://stackoverflow.com/questions/3687358/whats-the-best-way-to-get-the-last-element-of-an-array-without-deleting-it
			$lastEl = array_values(array_slice($ergebnis['themen'], -1))[0];
			
			foreach($ergebnis['themen'] as $thema) {	
				
				if($thema == $lastEl) {
					
					echo $thema;
					
				}
				else {
					
					echo '' .$thema. ', ';
				}								
			}			
		}
		else {
			
			echo '
			<p style="margin-top: 0px;">
				<span class="os-sb">Keine thematische Übereinstimmung</span>';
			
		}
	
		echo '
		</p>';
		
		// Variablenvorbereitung für optionale PDF-Ausgabe
		$_SESSION['ergebnis_' .$i. ''] = $ergebnis;
		$i++;
	}
	
	echo '
	<p class="font-small"></p>
	
	<p class="font-medium os-sb">Weitere Themen, zu denen nicht jede Partei eine Aussage getroffen hat</p>
	<p class="font-small">Jede Partei bedient außerdem Nischenthemas, zu dem nur speziell diese eine Aussage getroffen hat. Es ist möglich, dass genau dieses Thema Ihnen jedoch besonders am Herz liegt, deshalb sollten Sie folgendes noch wissen:</p>
	
	<p class="font-medium os-sb"></p>
	<p class="font-small"></p>
	</div>
	
	<div class="middle-right">
	
	<p class="font-medium os-sb">Zitatnachweise</p>
	<p class="font-small">Sämtliche Zitate wurden direkt und ausschließlich den öffentlich zugänglichen Wahlprogrammen entnommen, anonymisiert und inhaltlich auf den Kern reduziert, falls längenbedingt notwendig.<br />
	Im Folgenden finden Sie eine Sammlung von Links zu den jeweiligen Programmen, einmal lokal gespeichert, in denen die entnommenen Zitate markiert sind, einmal von offizieller Seite.</p>
	
	<table style="width: calc(100% - 40px); margin: 0 auto; text-align: center;">
		<thead>
			<tr>
				<th>Partei</th>
				<th>PDF mit Markierungen</th>
				<th>Offizieller Link</th></tr>
		</thead>
		<tbody>
			<tr>
				<td>AfD</td>
				<td><a href="">Link</a></td>
				<td><a href="https://www.afd.de/wp-content/uploads/sites/111/2017/05/2017-05-19_AfD-Bundestagswahlprogramm_Onlinefassung.pdf" target="_blank" title="AfD Bundestagswahlprogramm Onlinefassung">Link</ta></td>
			</tr>
			<tr>
				<td>CDU/CSU</td>
				<td><a href="">Link</a></td>
				<td><a href="" target="_blank" title="CDU/CSU Wahlprogramm">Link</ta></td>
			</tr>
			<tr>
				<td>Bündnis 90/Die Grünen</td>
				<td><a href="">Link</a></td>
				<td><a href="" target="_blank" title="Bündnis 90/Die Grünen Wahlprogramm">Link</ta></td>
			</tr>
			<tr>
				<td>Die Linke</td>
				<td><a href="">Link</a></td>
				<td><a href="" target="_blank" title="Die Linke Wahlprogramm">Link</ta></td>
			</tr>
			<tr>
				<td>FPD</td>
				<td><a href="">Link</a></td>
				<td><a href="http://fdp.de/wahlprogramm" target="_blank" title="FDP Wahlprogramm">Link</ta></td>
			</tr>
			<tr>
				<td>SPD</td>
				<td><a href="">Link</a></td>
				<td><a href="" target="_blank" title="SPD Wahlprogramm">Link</ta></td>
			</tr>
		</tbody>
	</table>
	
	<p class="font-medium os-sb">Ihr persönliches Ergebnis als Download</p>
	<p class="font-small">Sie möchten Ihr Ergebnis speichern? Folgende ergebnisbezogene Möglichkeiten stehen zur Verfügung:</p>
	<p class="font-small">– <a href="modules/pdf.php" target="_blank" title="PDF-Datei herunterladen">PDF-Datei herunterladen</a></p>
	<p class="font-small">unten rechts finden Sie außerdem alle Sharingfunktionen ohne Ihr eingebettetes Ergebnis</p>
	
	</div>';


}

?>