<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'save.php' );
	die();
}

session_start();

if ( isset( $_POST[ 'thema' ] ) && is_numeric( $_POST[ 'thema' ] ) && isset( $_POST[ 'zitat' ] ) && is_numeric( $_POST[ 'zitat' ] ) ) {

	$_SESSION[ 'thema' . $_POST[ 'thema' ] . '_antwort' ] = $_POST[ 'zitat' ];

	if ( $_SESSION[ 'thema' . $_POST[ 'thema' ] . '_antwort' ] ) {

		echo '		
		<script type="text/javascript">
			start(\'' . $_SESSION[ 'themenreihenfolge' ] . '\');
		</script>';

	}

}

?>