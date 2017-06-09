<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'edit.php' );
}

session_start();

if(isset($_POST[ 'reihenfolge' ]) && isset($_POST[ 'thema' ]) && is_numeric($_POST[ 'thema' ])) {
	
	$derzeitiges_thema = $_POST[ 'thema' ];
	
	include('anbindung.php');
	
	// Themenmenge via DB zählen
	$themenmenge = mysqli_num_rows( mysqli_query( $stream, "SELECT * FROM `themenuebersicht`" ) );
	
	// Themenkonvertierung
	$themen = explode( '.', $_POST[ 'reihenfolge' ] );
	
	// bisherige Antwort auswählen
	foreach($themen as $key => $value) {
		
		if($value == $derzeitiges_thema) {			
			$interne_position = $key;			
		}		
	}
	
	$wahl = $_SESSION['thema' .$interne_position. '_antwort'];
		
	// derzeitigen Themennamen auswählen
	$topic_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $derzeitiges_thema . "'" ) ); $topic_name = $topic_name[ 'thema' ];

	// Themen abholen aus DB abhängig $derzeitiges_thema, z.B. $_SESSION['thema(4-1)_zitat0']
	$zitatreihenfolge = '' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat0' ] . '.	' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat1' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat2' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat3' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat4' ] . '.' . $_SESSION[ 'thema' . ( $derzeitiges_thema - 1 ) . '_zitat5' ] . '';

	$zitatreihenfolge = explode( '.', $zitatreihenfolge );

	for ( $i = 1; $i <= 6; $i++ ) {

		${'quote' . $i . ''} = mysqli_fetch_array( mysqli_query( $stream, "SELECT `zitat` FROM `" . $derzeitiges_thema . "` WHERE `id` = '" . $zitatreihenfolge[ ( $i - 1 ) ] . "'" ) ); ${'quote' . $i . ''} = $ {'quote' . $i . ''}[ 'zitat' ];

	}	

	echo '
	<div class="middle-top">
			
		<span class="os-sb font-large" style="cursor: text;"><span class="topic_name">Bearbeitung: ' . $topic_name . '</span> (Thema ' . ($interne_position+1) . ' von ' . $themenmenge . ')</span>
	
		<div class="continue">
			<button onclick="sichern(\'' . $interne_position . '\');">Sichern</button>
		</div>
	</div>
	
	<div class="middle-left">
	';

	for ( $i = 1; $i <= 6; $i++ ) {
		
		if($i == $wahl) {
			$checked = 'checked';
		}
		else {
			$checked = '';
		}

		echo '
			<p class="quote">
				<input type="checkbox" ' .$checked. ' value="' . $i . '" id="' . $i . '"/> <label for="' . $i . '">' . ${'quote' . $i . ''} . '</label>
			</p>';

	}

	echo '
	</div>	
	
	<div class="middle-right">
	
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
		
		// wenn $i = derzeitiger Fortschritt, zeige anderes Icon an
		$topic_overview_name = mysqli_fetch_array( mysqli_query( $stream, "SELECT `thema` FROM `themenuebersicht` WHERE `id` = '" . $themen[ ( $i - 1 ) ] . "'" ) );
		$topic_overview_name = $topic_overview_name[ 'thema' ];

		if ( $i == ($interne_position+1) ) {			
			echo '
			<p title="Derzeitiges Thema" class="former-topic" style="cursor: text;">' . $i . '. ' . $topic_overview_name . ' ' . $topic_current_icon . '</p>';

		} elseif(!empty($_SESSION['thema' .($i-1). '_antwort'])) {
			// solange $i kleiner als Fortschritt ist (folglich absolvierte Fragen), zeige Themennamen an			
			echo '
			<p title="Thema ' .$topic_overview_name. '" class="former-topic" style="cursor: pointer;" onclick="edit(\'' . $_SESSION[ 'themenreihenfolge' ] . '-' .$themen[($i-1)]. '\');">' . $i . '. ' . $topic_overview_name . ' ' . $topic_completed_icon . '</p>';
		}
		elseif(empty($_SESSION['thema' .($i-1). '_antwort'])) {
			// für alle weiteren Themen die noch nicht beantwortet wurden, zeige kein Thema an sowie anderes Icon
			echo '
			<p title="Verborgen - wird mit Fortschritt im Fragebogen sichtbar">' . $i . '. ' . $topic_upcoming_icon . '</p>';			
			
		}
	}

	echo '
	</div>
	
	<script type="text/javascript">
		$(\'.middle-left input:checkbox\').click(function() {
		$(\'.middle-left input:checkbox\').not(this).prop(\'checked\', false);
	});   
	</script>
	<script type="text/javascript">
		window.history.pushState(\'Wahlorientierungshilfe - Bearbeitung ' . $topic_name . '\', \'Wahlorientierungshilfe - Bearbeitung ' . $topic_name . '\', \'\');
		document.title = \'Wahlorientierungshilfe - Bearbeitung ' . $topic_name . '\';
	</script>';

}

?>