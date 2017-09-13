<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'pdf.php' );
	die();
}

session_start();

if ( empty( $_GET ) && empty( $_POST ) ) {

	// erlaube PDF-Ausgabe nur wenn in dieser Session alle Fragen beantwortet wurden, um reverse-engineering / Zitat-Parteien-Zuordnung zu verhindern
	include( 'anbindung.php' );

	// Themenmenge via DB zählen
	$themenmenge = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `themenuebersicht`" ) );

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

	// falls keine Fragen offen sind
	if ( $uebrige_fragen == 0 ) {

		require_once( 'ext/fpdf181/fpdf.php' );
		require_once( 'ext/fpdi162/fpdi.php' );

		$pdf = new FPDI();

		$pageCount = $pdf->setSourceFile( 'ext/vorlage.pdf' );
		$tplIdx = $pdf->importPage( 1 );

		// Fonts mit http://fpdf.de/tools/truetype-konverter/truetype-schriftarten-konverter.html aus ttf konvertiert
		// Fonts von https://www.fontsquirrel.com/fonts/open-sans
		$pdf->AddFont( 'Opensans-regular', '', 'Opensans-regular.php' );
		$pdf->AddFont( 'Opensans-semibold', '', 'Opensans-semibold.php' );
		$pdf->AddFont( 'Opensans-italic', '', 'Opensans-italic.php' );
		$pdf->AddPage( 'L' );
		$pdf->useTemplate( $tplIdx, 0, 0, 297, 210 );
		$pdf->SetAuthor( 'Wahlorientierungshilfe 2017 - https://wahl2017.gerritalex.de' );

		$pdf->SetTitle( 'Wahlorientierungshilfe 2017 - Auswertung' );

		$ergebnis_array = array();
		for ( $i = 0; $i <= 5; $i++ ) {

			array_push( $ergebnis_array, $_SESSION[ 'ergebnis_' . $i . '' ] );

		}

		function drawTopic( $x ) {

			global $lastEl, $ergebnis, $pdf, $i;

			$pdf->SetTextColor( 0, 0, 0 );

			// falls mehrere Themen bei dieser Partei gewählt wurden, Zeile mit mit 'Themen: ' beginnen
			if ( isset( $ergebnis[ 'themen' ][ 0 ] ) && isset( $ergebnis[ 'themen' ][ 1 ] ) ) {
				$start = 'Themen: ';
				$string_width = $pdf->GetStringWidth( $start );
				$pdf->Text( 12.7, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $start ) );
			}
			// falls nur ein Thema gewählt wurde, Zeile mit 'Thema: ' beginnen
			elseif ( isset( $ergebnis[ 'themen' ][ 0 ] ) && !isset( $ergebnis[ 'themen' ][ 1 ] ) ) {
				$start = 'Thema: ';
				$string_width = $pdf->GetStringWidth( $start );
				$pdf->Text( 12.7, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $start ) );
			}

			// neue x-Position = Zeile + Einleitung
			$x = $x + $string_width;

			foreach ( $ergebnis[ 'themen' ] as $thema ) {

				// derzeitiges Thema letztes Thema?
				if ( $thema == $lastEl ) {
					// falls derzeitiges Thema aufgewertet wurde
					if ( strpos( $thema, '<span class="os-sb" style="color: rgb(79, 176, 198);">' ) !== FALSE ) {

						$pdf->SetTextColor( 79, 176, 198 );
						$pdf->SetFont( 'Opensans-semibold', '', 11 );

						$thema = substr( $thema, 54, -7 );

						$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
					}
					// falls derzeitiges Thema abgewertet wurde
					elseif ( strpos( $thema, '<span style="opacity: 0.25;">' ) !== FALSE ) {

							$pdf->SetTextColor( 208, 208, 208 );
							$pdf->SetFont( 'Opensans-regular', '', 11 );

							$thema = substr( $thema, 29, -7 );

							$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
						}
						// falls weder aufgewertet noch abgewertet
					else {

						$pdf->SetTextColor( 0, 0, 0 );
						$pdf->SetFont( 'Opensans-regular', '', 11 );
						$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
					}

					$string_width = $pdf->GetStringWidth( $thema );

					// neue x-Position = Zeile + Einleitung
					$x = $x + $string_width;
				}
				// falls derzeitiges THema nicht letztes Thema ist
				else {
					// falls derzeitiges Thema aufgewertet wurde
					if ( strpos( $thema, '<span class="os-sb" style="color: rgb(79, 176, 198);">' ) !== FALSE ) {

						$pdf->SetTextColor( 79, 176, 198 );
						$pdf->SetFont( 'Opensans-semibold', '', 11 );

						$thema = substr( $thema, 54, -7 );

						$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
					}
					// falls derzeitiges Thema abgewertet wurde
					elseif ( strpos( $thema, '<span style="opacity: 0.25;">' ) !== FALSE ) {

						$pdf->SetTextColor( 0, 0, 0 );
						$pdf->SetFont( 'Opensans-regular', '', 11 );

						$thema = substr( $thema, 29, -7 );

						$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
					}
					else {

						$pdf->SetTextColor( 0, 0, 0 );
						$pdf->SetFont( 'Opensans-regular', '', 11 );

						$thema = $thema;

						$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $thema ) );
					}

					$string_width = $pdf->GetStringWidth( $thema );

					// neue x-Position = Zeile + Einleitung
					$x = $x + $string_width;

					$komma = ', ';

					$pdf->SetFont( 'Opensans-regular', '', 11 );
					$pdf->SetTextColor( 0, 0, 0 );
					$pdf->Text( $x, 99.964 + 3.125 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', $komma ) );

					$string_width = $pdf->GetStringWidth( $komma );

					// neue x-Position = Zeile + Einleitung
					$x = $x + $string_width;

				}
			}

		}

		$i = 0;

		foreach ( $ergebnis_array as $ergebnis ) {

			$prozent = $ergebnis[ 'counter' ] / $themenmenge * 100;
			$prozent_fill = $ergebnis[ 'counter' ] / $themenmenge * 271.6;

			list( $r, $g, $b ) = sscanf( '#' . $ergebnis[ 'hex' ] . '', "#%02x%02x%02x" );

			$pdf->SetDrawColor( $r, $g, $b );
			$pdf->SetFillColor( $r, $g, $b );
			$pdf->SetLineWidth( 0.1 );

			$pdf->Rect( 12.7, ( 92.24 + $i * 14.312 ), 271.6, 3.075, 'D' );
			$pdf->Rect( 12.7, ( 92.24 + $i * 14.312 ), $prozent_fill, 3.075, 'F' );

			$pdf->SetFont( 'Opensans-semibold', '', 11 );

			$pdf->Text( 12.7, 96.052 + 3.175 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', '' . $prozent . '% - ' . $ergebnis[ 'partei' ] . '' ) );


			if ( !empty( $ergebnis[ 'themen' ] ) ) {

				$lastEl = array_values( array_slice( $ergebnis[ 'themen' ], -1 ) )[ 0 ];

				if ( !isset( $x ) ) {
					$x = 12.7;
				}

				drawTopic( $x );

			} else {
				$pdf->Text( 12.7, 99.964 + 3.175 + $i * 14.312, iconv( 'UTF-8', 'windows-1252', 'Keine thematische Übereinstimmung' ) );
			}

			$i++;

		}

		$pdf->SetFont( 'Opensans-italic', '', 12 );
		$pdf->SetTextColor( 255, 255, 255 );

		$pdf->Text( 244.85, 194.061 + 3.229, iconv( 'UTF-8', 'windows-1252', date( 'G:i', time( 'now' ) ) ) );

		$pdf->Text( 263.6, 194.061 + 3.229, iconv( 'UTF-8', 'windows-1252', date( 'd.m.Y', time( 'now' ) ) ) );

		$pdf->Output( 'D', 'Wahlorientierungshilfe 2017 - Auswertung.pdf' );
	}
}

?>