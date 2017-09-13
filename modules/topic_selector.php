<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'topic_selector.php' );
	die();
}

session_start();

if ( isset( $_POST[ 'reihenfolge' ] ) ) {

	///////////////////////////////////////////////////////////////
	// SESSION Debug – falls Seite länger als Sessiondauer offen war, ist die Session ausgelaufen bis der Nutzer Start anklickt

	if ( empty( $_SESSION[ 'themenreihenfolge' ] ) || !isset( $_SESSION[ 'themenreihenfolge' ] ) ) {

		echo '
		<div class="middle-top">Durch zu lange Inaktivität ist Ihre zufallsgenerierte Themenreihenfolge aus Sicherheitsgründen verfallen.<br /><a href="https://wahl2017.gerritalex.de/">Bitte klicken Sie hier, um eine neue zu generieren und anschließend erneut auf Start.</a></div>';

		die();
	}

	///////////////////////////////////////////////////////////////


	include( 'anbindung.php' );

	// Themenmenge via DB zählen
	$themenmenge = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `themenuebersicht`" ) );

	// Themenkonvertierung
	$themen = explode( '.', $_POST[ 'reihenfolge' ] );

	//////////////////////////////////////////////////////////
	// Subabfrage für Fortschrittsdokumentierung via $_SESSION
	// falls $_POST['zitat'] && $_POST['thema] gesetzt sind (via js-Funktion next_topic();)
	if ( isset( $_POST[ 'zitat' ] ) && is_numeric( $_POST[ 'zitat' ] ) && $_POST[ 'zitat' ] > 0 && isset( $_POST[ 'thema' ] ) ) {

		// Themenkonvertierung von plain text -> interne ID
		$themen_id = mysqli_fetch_array( mysqli_query( $stream, "SELECT `id` FROM `themenuebersicht` WHERE `thema` = '" . $_POST[ 'thema' ] . "'" ) );
		$themen_id = $themen_id[ 'id' ];

		// individuelle Reihenfolgenposition ausfindig machen
		for ( $i = 0; $i <= ( $themenmenge - 1 ); $i++ ) {
			if ( $themen[ $i ] == $themen_id ) {
				// Antwort eintragen
				$_SESSION[ 'thema' . $i . '_antwort' ] = $_POST[ 'zitat' ];
			}
		}
	}
	//////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////
	// Subabfrage zur Prüfung ob Nutzer alle Fragen beantwortet hat
	$antwort_array = array();
	for ( $i = 0; $i <= ( $themenmenge - 1 ); $i++ ) {
		array_push( $antwort_array, $_SESSION[ 'thema' . $i . '_antwort' ] );
	}

	$uebrige_fragen = $themenmenge;

	foreach ( $antwort_array as $antwort ) {
		if ( !empty( $antwort ) ) {
			$uebrige_fragen = $uebrige_fragen - 1;
		}
	}
	//////////////////////////////////////////////////////////

	// falls Fragen offen sind
	if ( $uebrige_fragen != 0 ) {

		$derzeitiges_thema = '';

		// SESSION-Werte für Topics checken, letztes leeres nehmen und auswählen
		for ( $i = 0; $i <= ( $themenmenge - 1 ); $i++ ) {
			// solange noch kein unbeantwortetes Thema gefunden wird:
			if ( empty( $derzeitiges_thema ) ) {
				// Iterationen bis unbeantwortetes Thema gefunden wird ($_SESSION['thema0_antwort'])
				if ( empty( $_SESSION[ 'thema' . $i . '_antwort' ] ) ) {
					// Thema auswählen => z.B. $themen[0] = 4
					$derzeitiges_thema = $themen[ $i ];

					// derzeitiger Fortschritt
					$_SESSION[ 'fortschritt' ] = $i + 1;
				}
			}
		}

		// derzeitigen Themennamen auswählen
		$topic_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $derzeitiges_thema . "'" ) );
		$topic_name = $topic_name[ 'thema' ];

		// Themen abholen aus DB abhängig $derzeitiges_thema, z.B. $_SESSION['thema(4-1)_zitat0']
		$zitatreihenfolge = '' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat0' ] . '.	' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat1' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat2' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat3' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat4' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat5' ] . '';

		$zitatreihenfolge = explode( '.', $zitatreihenfolge );

		for ( $i = 1; $i <= 6; $i++ ) {

			${'quote' . $i . ''} = mysqli_fetch_array( mysqli_query( $stream, "SELECT `zitat` FROM `" . $derzeitiges_thema . "` WHERE `id` = '" . $zitatreihenfolge[ ( $i - 1 ) ] . "'" ) );
			${'quote' . $i . ''} = ${'quote' . $i . ''}[ 'zitat' ];

		}

		// vorheriges Thema für Zurück-Funktion auswählen
		foreach ( $themen as $key => $value ) {

			if ( $value == $derzeitiges_thema ) {
				$interne_position = ( $key - 1 );
			}
		}

		echo '
		<div class="middle-top">';

		if ( $_SESSION[ 'fortschritt' ] >= 2 ) {
			echo '
			<div class="back">
				<button onclick="edit(\'' . $_SESSION[ 'themenreihenfolge' ] . '-' . $themen[ ( $_SESSION[ 'fortschritt' ] - 2 ) ] . '\');">
					<svg fill="#4fb0c6" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg" style="transform: rotate(180deg);">
						<path d="M8 5v14l11-7z"></path>
						<path d="M0 0h24v24H0z" fill="none"></path>
					</svg>Zurück			
				</button>
			</div>';
		}

		echo '		
			<span class="os-sb font-large" style="cursor: text;"><span class="topic_name">' . $topic_name . '</span> (Thema ' . $_SESSION[ 'fortschritt' ] . ' von ' . $themenmenge . ')</span>
		
			<div class="continue">
				<button onclick="next_topic(\'' . $_SESSION[ 'themenreihenfolge' ] . '\');">
					Weiter<svg fill="#4fb0c6" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
						<path d="M8 5v14l11-7z"></path>
						<path d="M0 0h24v24H0z" fill="none"></path>
					</svg>
				</button>
			</div>
		</div>
	
		<div class="middle-left">
		';

		for ( $i = 1; $i <= 6; $i++ ) {
			
			if($i != 6) {
				$hr = '<hr style="border: 0.2px solid rgb(79, 176, 198);">';
			}
			else {
				$hr = '';
			}

			echo '
			<p class="quote">
				<input type="checkbox" value="' . $i . '" id="' . $i . '"/> <label for="' . $i . '">' . $ {
				'quote' . $i . ''
			} . '</label>
			</p>
			' .$hr. '';

		}
		
		
		// PHP Session läuft nach standardisierten 24 Minuten aus (1440 Sekunden)
		$expiration_time = date('G:i:s', (time('now')+1440));

		echo '
		</div>	
	
		<div class="middle-right">
		
			<p class="font-small">Meinung zu einem Thema geändert? Einfach unten auf ein bereits geantwortetes Thema klicken!</p>			
			
			<p class="font-tiny">Bitte beachten Sie: um <b>' .$expiration_time. '</b> verfällt aus datenschutztechnischen Gründen Ihr Fortschritt. Pro Thema haben Sie 24 Minuten Zeit.</p>
	
			<!-- Icons von https://material.io/icons - Google Material Design Icons -->			
		';

		// Lupe
		$topic_current_icon = '
		<svg style="vertical-align: text-bottom;" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/><path d="M0 0h24v24H0z" fill="none"/></svg>';

		// Check
		$topic_completed_icon = '
		<svg style="vertical-align: text-bottom;" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0z" fill="none"/><path d="M9 16.2L4.8 12l-1.4 1.4L9 19 21 7l-1.4-1.4L9 16.2z"/></svg>';

		// Verborgen
		$topic_upcoming_icon = '
		<svg style="vertical-align: text-bottom;" fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"><path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>';

		// zeige basierend auf Themenanzahl und Fortschritt ausgewürfelte Themen an
		for ( $i = 1; $i <= $themenmenge; $i++ ) {

			// solange $i kleiner als Fortschritt ist (folglich absolvierte Fragen), zeige Themennamen an
			if ( $i < $_SESSION[ 'fortschritt' ] ) {

				$topic_overview_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $themen[ ( $i - 1 ) ] . "'" ) );
				$topic_overview_name = $topic_overview_name[ 'thema' ];

				echo '
				<p title="Klicken um zum Thema zurückzukehren" class="former-topic" onclick="edit(\'' . $_SESSION[ 'themenreihenfolge' ] . '-' . $themen[ ( $i - 1 ) ] . '\');">' . $i . '. ' . $topic_overview_name . ' ' . $topic_completed_icon . '</p>';

			} elseif ( $i == $_SESSION[ 'fortschritt' ] ) {

				// wenn $i = derzeitiger Fortschritt, zeige anderes Icon an
				$topic_overview_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $themen[ ( $i - 1 ) ] . "'" ) );
				$topic_overview_name = $topic_overview_name[ 'thema' ];

				echo '
				<p title="Derzeitiges Thema" class="former-topic" style="cursor: text;">' . $i . '. ' . $topic_overview_name . ' ' . $topic_current_icon . '</p>';

			} elseif ( $i > $_SESSION[ 'fortschritt' ] ) {
				// für alle weiteren Themen die noch nicht beantwortet wurden, zeige kein Thema an sowie anderes Icon
				echo '
				<p title="Verborgen - wird mit Fortschritt im Fragebogen sichtbar">' . $i . '. ' . $topic_upcoming_icon . '</p>';

			}
		}

		if ( !empty( $_SESSION[ 'thema0_antwort' ] ) ) {

			echo '
			<p>Thema anklicken um Meinung zu ändern!</p>
			<p><button onclick="restart();" class="restart">Neustart (Fortschritt wird gelöscht)</button></p>
			';

		}

		echo '
		</div>
	
		<script type="text/javascript">
			$(\'.middle-left input:checkbox\').click(function() {
			$(\'.middle-left input:checkbox\').not(this).prop(\'checked\', false);
		});   
		</script>
		<script type="text/javascript">
			window.history.pushState(\'Wahlorientierungshilfe - Thema ' . $_SESSION[ 'fortschritt' ] . '\', \'Wahlorientierungshilfe - Thema ' . $_SESSION[ 'fortschritt' ] . '\', \'\');
			document.title = \'Wahlorientierungshilfe - Thema ' . $_SESSION[ 'fortschritt' ] . '\';
		</script>
		';
	}

	// sobald alle Fragen beantwortet wurden
	elseif ( $uebrige_fragen == 0 ) {

		echo '
		<style type="text/css">
		
		.middle-left {
			width: 100vw;
		}
		</style>';

		$abgewertet = 0;
		$aufgewertet = 0;

		if ( isset( $_SESSION[ 'aufwerten1' ] ) ) {
			$aufgewertet = $aufgewertet + 1;
		}
		if ( isset( $_SESSION[ 'aufwerten2' ] ) ) {
			$aufgewertet = $aufgewertet + 1;
		}
		if ( isset( $_SESSION[ 'abwerten1' ] ) ) {
			$abgewertet = $abgewertet + 1;
		}
		if ( isset( $_SESSION[ 'abwerten2' ] ) ) {
			$abgewertet = $abgewertet + 1;
		}


		echo '
		<div class="middle-top">
				
			<span class="os-sb font-large" style="cursor: text;">Gewichtung <span class="os-sb font-large">(<span class="abgewertet">' . $abgewertet . '</span>/2 entwertet, <span class="aufgewertet">' . $aufgewertet . '</span>/2 aufgewertet)</span></span>
		
			<div class="continue">
				<button onclick="auswerten(\'' . $_SESSION[ 'themenreihenfolge' ] . '\');">Auswerten</button>
			</div>
		</div>
		
		<div class="middle-left">
		
		<img src="img/x1.png" hidden />
		
		<table style="margin: 0 auto;">
			<thead>
			</thead>
			<tbody>
			<tr><td class="os-sb" colspan="5" style="text-align: center;">Sie können nun einzelne Themen nachträglich bearbeiten und gewichten, müssen aber nicht.</td></tr>
			<tr><td class="os-sb" colspan="5" style="text-align: center;">Nach einem Klick auf eines der Icons verändert sich das Feld um die Rückkehr zum Ursprungswert zu ermöglichen.</td></tr>
			<tr><td class="os-sb" colspan="5" style="text-align: center;">Zitate in <span style="color: rgb(79, 176, 198);">blau & bold</span> wurden aufgewertet, <span style="opacity: 0.25;">ausgeblendete</span> entwertet.</td></tr>
			';

		$i = 0;

		// Beispiel
		// Themenreihenfolge = 4 2 1 3 (erreichbar via $themen[$i])
		// Thema1 = SESSION['thema0'] Zitatreihenfolge = 4 1 3 6 5 2
		// Thema2 = SESSION['thema1'] Zitatreihenfolge = 5 4 3 1 2 6
		// Thema3 = SESSION['thema2'] Zitatreihenfolge = 6 5 3 2 1 4
		// Thema4 = SESSION['thema3'] Zitatreihenfolge = 4 5 1 6 2 3
		//
		// ausgewählt wurden als Antwort:
		// thema0_antwort = 3 ist aber eigentlich $themen[0] = Thema4 => SESSION['thema3_zitat3']
		// thema1_antwort = 5 ist aber eigentlich $themen[1] = Thema2 => SESSION['thema1_zitat5']
		// thema2_antwort = 3 ist aber eigentlich $themen[2] = Thema1 => SESSION['thema0_zitat3']
		// thema3_antwort = 6 ist aber eigentlich $themen[3] = Thema3 => SESSION['thema2_zitat6']
		//
		// Antworten sind, da checkbox-Values 1-6 sind, auch automatisch in $_SESSION eins höher
		// $_SESSION['thema' .($themennummer-1).'_zitat' .($antwort-1). ''];

		foreach ( $antwort_array as $antwort ) {

			$themennummer = $themen[ $i ];

			$session_antwort = $_SESSION[ 'thema' . ( $themennummer - 1 ) . '_zitat' . ( $antwort - 1 ) . '' ];

			$themenname = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $themennummer . "'" ) );
			$themenname = $themenname[ 'thema' ];
			$zitat = mysqli_fetch_array( mysqli_query( $stream, "SELECT LEFT(`zitat`, 75) as `zitat_short`, `zitat` AS `zitat_full` FROM `" . $themennummer . "` WHERE `id` = '" . $session_antwort . "'" ) );
			$zitat = '' . trim( $zitat[ 'zitat_short' ] ) . '... <sup style="cursor: pointer; color: rgb(79, 176, 198);" onclick="alert(\'' . $themenname . '\n' . trim( $zitat[ 'zitat_full' ] ) . '\');">Komplettzitat</sup>';


			$x0 = '<img src="img/x0.png" alt="x0" title="Dieses Thema nicht werten" style="cursor: pointer; height: 50px;" id="' . $themennummer . '" onclick="abwerten(this.id);" />';
			$x1 = '<img src="img/x1.png" alt="x1" title="Dieses Thema nicht werten" style="cursor: pointer; height: 50px;" id="' . $themennummer . '" onclick="gleichstellen(this.id);" />';
			$x2 = '<img src="img/x2.png" alt="x2" title="Dieses Thema doppelt werten" style="cursor: pointer; height: 50px;" id="' . $themennummer . '" onclick="aufwerten(this.id);" />';
			$change = '<img src="img/back.png" alt="verändern" title="Meinung geändert? Anklicken um Thema neu zu beantworten" style="cursor: pointer; height: 50px;" id="' . $themennummer . '" onclick="edit(\'' . $_SESSION[ 'themenreihenfolge' ] . '-' . $themennummer . '\');" />';

			// falls keine Gewichtungen vorgenommen wurden
			if ( !isset( $_SESSION[ 'abwerten1' ] ) && !isset( $_SESSION[ 'abwerten2' ] ) && !isset( $_SESSION[ 'aufwerten1' ] ) && !isset( $_SESSION[ 'aufwerten2' ] ) ) {

				echo '
				<tr id="' . $themennummer . '" style="transition: all 1s ease-in-out 0s;">
					<td class="os-sb">' . $themenname . '</td>
					<td>' . $zitat . '</td>
					<td>' . $change . '</td>
					<td>' . $x0 . '</td>
					<td>' . $x2 . '</td>
				</tr>';
			}
			// falls bereits Gewichtungen vorgenommen wurden, müssen diese hier visuell berücksichtigt werden
			elseif ( isset( $_SESSION[ 'abwerten1' ] ) || isset( $_SESSION[ 'abwerten2' ] ) || isset( $_SESSION[ 'aufwerten1' ] ) ||  isset( $_SESSION[ 'aufwerten2' ] ) ) {

				// falls DIESES Thema = abgewertet
				if ( ( $themennummer == $_SESSION[ 'abwerten1' ] ) || ( $themennummer == $_SESSION[ 'abwerten2' ] ) ) {
					echo '
					<tr id="' . $themennummer . '" style="transition: all 1s ease-in-out 0s;">
						<td class="os-sb">' . $themenname . '</td>
						<td style="opacity: 0.25;">' . $zitat . '</td>
						<td>' . $change . '</td>
						<td>' . $x1 . '</td>
						<td>' . $x2 . '</td>
					</tr>';
				}
				// falls DIESES Thema = aufgewertet
				elseif ( ( $themennummer == $_SESSION[ 'aufwerten1' ] ) || ( $themennummer == $_SESSION[ 'aufwerten2' ] ) ) {
						echo '
					<tr id="' . $themennummer . '" style="transition: all 1s ease-in-out 0s;">
						<td class="os-sb">' . $themenname . '</td>
						<td style="font-weight: 700; color: rgb(79, 176, 198);">' . $zitat . '</td>
						<td>' . $change . '</td>
						<td>' . $x0 . '</td>
						<td>' . $x1 . '</td>
					</tr>';
					}
					// falls dieses Thema = normal
				elseif ( ( $themennummer != $_SESSION[ 'aufwerten1' ] ) && ( $themennummer != $_SESSION[ 'aufwerten2' ] ) && ( $themennummer != $_SESSION[ 'abwerten1' ] ) && ( $themennummer != $_SESSION[ 'abwerten2' ] ) ) {
					echo '
					<tr id="' . $themennummer . '" style="transition: all 1s ease-in-out 0s;">
						<td class="os-sb">' . $themenname . '</td>
						<td>' . $zitat . '</td>
						<td>' . $change . '</td>
						<td>' . $x0 . '</td>
						<td>' . $x2 . '</td>
					</tr>';
				}
			}

			$i++;
		}

		echo '
			</tbody>
			</table>
		</div>';


		echo '
		<script type="text/javascript">
			window.history.pushState(\'Wahlorientierungshilfe - Gewichtung\', \'Wahlorientierungshilfe - Gewichtung\', \'\');
			document.title = \'Wahlorientierungshilfe - Gewichtung\';
		</script>';

	}
}



?>