<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'session_remover.php' );
	die();
}

session_start();

session_destroy();

?>