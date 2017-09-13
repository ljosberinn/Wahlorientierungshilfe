<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'weighting.php' );
	die();
}

session_start();

if ( isset( $_POST[ 'thema' ] ) && is_numeric( $_POST[ 'thema' ] ) ) {

	// Thema annullieren
	if ( isset( $_POST[ 'abwerten' ] ) && $_POST[ 'abwerten' ] == 'true' ) {

		// erstes Mal abwerten
		if ( !isset( $_SESSION[ 'abwerten1' ] ) ) {
			$_SESSION[ 'abwerten1' ] = $_POST[ 'thema' ];

			if ( isset( $_SESSION[ 'abwerten1' ] ) ) {
				echo '
				<script type="text/javascript">
					$(\'.abgewertet\').html(\'1\');
				</script>';
			}
		} elseif ( isset( $_SESSION[ 'abwerten1' ] ) && !isset( $_SESSION[ 'abwerten2' ] ) ) {
			// zweites Mal abwerten	
			$_SESSION[ 'abwerten2' ] = $_POST[ 'thema' ];

			if ( isset( $_SESSION[ 'abwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					$(\'.abgewertet\').html(\'2\');
				</script>';
			}
		}
		elseif ( isset( $_SESSION[ 'abwerten1' ] ) && isset( $_SESSION[ 'abwerten1' ] ) ) {
			// n-tes Mal abwerten
			echo '
			<script type="text/javascript">
				alert(\'Achtung: Sie haben bereits zwei Themen entwertet. Wenn Sie dieses Thema entwerten möchten, klicken Sie bei einem bisherig entwerteten Thema bitte zuerst auf \'normal werten\' und anschließend bei diesem auf \'nicht werten\'.\');
			</script>';
			
			/*
			
			<script type="text/javascript">
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(2)\').css(\'color\', \'black\');
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(2)\').css(\'opacity\', \'1\');
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(2)\').css(\'font-weight\', \'500\');
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(4)\').empty();
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(5)\').empty();
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(4)\').append(\'<img src="img/x0.png" style="height: 50px; pointer-events: all; cursor: pointer;" alt="x0" title="Dieses Thema nicht werten" id="' . $_SESSION[ 'abwerten1' ] . '" onclick="abwerten(this.id);" />\');
				$(\'#' . $_SESSION[ 'abwerten1' ] . '\').find(\'td:nth-child(5)\').append(\'<img src="img/x2.png" style="height: 50px; pointer-events: all; cursor: pointer;" alt="x2" title="Dieses Thema doppelt werten" id="' . $_SESSION[ 'abwerten1' ] . '" onclick="aufwerten(this.id);" />\');			
			</script>';

			$_SESSION[ 'abwerten1' ] = $_POST[ 'thema' ];
			*/

		}

		// Überschreiben anderer Gewichtung falls vorhanden (ab > auf)
		if ( $_POST[ 'thema' ] == $_SESSION[ 'aufwerten1' ] ) {
			unset( $_SESSION[ 'aufwerten1' ] );

			if ( !isset( $_SESSION[ 'aufwerten1' ] ) ) {

				echo '
				<script type="text/javascript">
					var aufgewertet = parseInt($(\'.aufgewertet\').text());
								
					switch (aufgewertet) {
						case 1:
							aufgewertet = 0;
							break;
						case 2:
							aufgewertet = 1;
							break;
					}
				
					$(\'.aufgewertet\').html(aufgewertet);
				</script>';
			}

		} elseif ( $_POST[ 'thema' ] == $_SESSION[ 'aufwerten2' ] ) {
			unset( $_SESSION[ 'aufwerten2' ] );

			if ( !isset( $_SESSION[ 'aufwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					var aufgewertet = parseInt($(\'.aufgewertet\').text());
				
					switch (aufgewertet) {
						case 1:
							aufgewertet = 0;
							break;
						case 2:
							aufgewertet = 1;
							break;
					}
				
					$(\'.aufgewertet\').html(aufgewertet);
				</script>';
			}
		}
	}
	// Thema aufwerten
	elseif ( isset( $_POST[ 'aufwerten' ] ) && $_POST[ 'aufwerten' ] == 'true' ) {

		// erstes Mal aufwerten
		if ( !isset( $_SESSION[ 'aufwerten1' ] ) ) {
			$_SESSION[ 'aufwerten1' ] = $_POST[ 'thema' ];
		
			if ( isset( $_SESSION[ 'aufwerten1' ] ) ) {
				echo '
				<script type="text/javascript">
					$(\'.aufgewertet\').html(\'1\');
				</script>';
			}
		}
		// zweites Mal aufwerten
		elseif ( isset( $_SESSION[ 'aufwerten1' ] ) && !isset( $_SESSION[ 'aufwerten2' ] ) ) {
			$_SESSION[ 'aufwerten2' ] = $_POST[ 'thema' ];
			
			if ( isset( $_SESSION[ 'aufwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					$(\'.aufgewertet\').html(\'2\');
				</script>';
			}
		}
		// n-tes Mal aufwerten
		elseif ( isset( $_SESSION[ 'aufwerten1' ] ) && isset( $_SESSION[ 'aufwerten1' ] ) ) {

			
			echo '
			<script type="text/javascript">
				alert(\'Achtung: Sie haben bereits zwei Themen aufgewertet. Wenn Sie dieses Thema aufwerten möchten, klicken Sie bei einem bisherig aufgewerteten Thema bitte zuerst auf \'normal werten\' und anschließend bei diesem auf \'doppelt werten\'.\');
			</script>';
			
			/*
			echo '
			<script type="text/javascript">
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(2)\').css(\'font-weight\', \'500\');
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(2)\').css(\'color\', \'black\');
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(4)\').empty();
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(5)\').empty();
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(4)\').append(\'<img src="img/x0.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x0" title="Dieses Thema nicht werten" id="' . $_SESSION[ 'aufwerten1' ] . '" onclick="abwerten(this.id);" />\');	
				$(\'#' . $_SESSION[ 'aufwerten1' ] . '\').find(\'td:nth-child(5)\').append(\'<img src="img/x2.png" style="height: 50px; opacity: 1; pointer-events: all; cursor: pointer;" alt="x2" title="Dieses Thema doppelt werten" id="' . $_SESSION[ 'aufwerten1' ] . '" onclick="aufwerten(this.id);" />\');	
			</script>';

			$_SESSION[ 'aufwerten1' ] = $_POST[ 'thema' ];
			*/
		}

		// Überschreiben anderer Gewichtung falls vorhanden (auf > ab)
		if ( $_POST[ 'thema' ] == $_SESSION[ 'abwerten1' ] ) {
			unset( $_SESSION[ 'abwerten1' ] );

			if ( !isset( $_SESSION[ 'abwerten1' ] ) ) {
				echo '
				<script type="text/javascript">
					var abgewertet = parseInt($(\'.abgewertet\').text());
								
					switch (abgewertet) {
						case 1:
							abgewertet = 0;
							break;
						case 2:
							abgewertet = 1;
							break;
					}
				
					$(\'.abgewertet\').html(abgewertet);
				</script>';
			}
		} elseif ( $_POST[ 'thema' ] == $_SESSION[ 'abwerten2' ] ) {
			unset( $_SESSION[ 'abwerten2' ] );

			if ( !isset( $_SESSION[ 'abwerten1' ] ) ) {
				echo '
				<script type="text/javascript">
					var abgewertet = parseInt($(\'.abgewertet\').text());
							
					switch (abgewertet) {
						case 1:
							abgewertet = 0;
							break;
						case 2:
							abgewertet = 1;
						break;
					}
			
					$(\'.abgewertet\').html(abgewertet);
				</script>';
			}
		}
	}
	// gleichstellen => anderer Wert muss bereits gesetzt sein der ursprünglich auf- oder abwertete
	elseif ( isset( $_POST[ 'gleichstellen' ] ) && $_POST[ 'gleichstellen' ] == 'true' ) {

		if ( $_POST[ 'thema' ] == $_SESSION[ 'abwerten2' ] ) {
			unset( $_SESSION[ 'abwerten2' ] );

			if ( !isset( $_SESSION[ 'abwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					var abgewertet = parseInt($(\'.abgewertet\').text());
								
					switch (abgewertet) {
						case 1:
							abgewertet = 0;
							break;
						case 2:
							abgewertet = 1;
							break;
					}
				
					$(\'.abgewertet\').html(abgewertet);
				</script>';
			}
		} elseif ( $_POST[ 'thema' ] == $_SESSION[ 'abwerten1' ] ) {
			unset( $_SESSION[ 'abwerten1' ] );

			if ( !isset( $_SESSION[ 'abwerten1' ] ) ) {
				echo '
				<script type="text/javascript">
					var abgewertet = parseInt($(\'.abgewertet\').text());
				
					switch (abgewertet) {
						case 1:
							abgewertet = 0;
							break;
						case 2:
							abgewertet = 1;
							break;
					}
				
					$(\'.abgewertet\').html(abgewertet);
				</script>';
			}
		}
		elseif ( $_POST[ 'thema' ] == $_SESSION[ 'aufwerten2' ] ) {
			unset( $_SESSION[ 'aufwerten2' ] );

			if ( !isset( $_SESSION[ 'aufwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					var aufgewertet = parseInt($(\'.aufgewertet\').text());
				
					switch (aufgewertet) {
						case 1:
							aufgewertet = 0;
							break;
						case 2:
							aufgewertet = 1;
							break;
					}	
				
					$(\'.aufgewertet\').html(aufgewertet);
				</script>';
			}
		}
		elseif ( $_POST[ 'thema' ] == $_SESSION[ 'aufwerten1' ] ) {
			unset( $_SESSION[ 'aufwerten1' ] );

			if ( !isset( $_SESSION[ 'aufwerten2' ] ) ) {
				echo '
				<script type="text/javascript">
					var aufgewertet = parseInt($(\'.aufgewertet\').text());
				
					switch (aufgewertet) {
						case 1:
							aufgewertet = 0;
							break;
						case 2:
							aufgewertet = 1;
							break;
					}				
				
					$(\'.aufgewertet\').html(aufgewertet);
				</script>';
			}
		}
	}
}


?>