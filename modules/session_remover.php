<?php

if ( isset( $_GET[ 'sourcecode' ] ) ) {
	highlight_file( 'session_remover.php' );
}

session_start();

session_destroy();

?>