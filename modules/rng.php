<?php

if(isset($_GET['sourcecode'])) {
	highlight_file('rng.php');
}

session_start();

// Quelle: http://stackoverflow.com/questions/5612656/generating-unique-random-numbers-within-a-range-php

function UniqueRandomNumbersWithinRange( $min, $max, $quantity ) {
	$numbers = range( $min, $max );
	shuffle( $numbers );
	return array_slice( $numbers, 0, $quantity );
}

include('anbindung.php');

// Themenmenge via DB zählen
$themenmenge = mysqli_num_rows(mysqli_query($stream, "SELECT * FROM `themenuebersicht`"));

// Bestimmung der Themenreihenfolge; Zufallszahl zwischen 1 und gezählter Themenmenge; gibt ein Array wieder
$themenreihenfolge = UniqueRandomNumbersWithinRange( 1, $themenmenge, $themenmenge );

for ( $i = 0; $i <= ($themenmenge-1); $i++ ) {

	// Beispiel $i = 0;
	// asugewürfelte Zufallszahl aus $themenreihenfolge-Array abholen, in diesem Fall ersten Wert [0]
	// $_SESSION['themenreihenfolge'].= '' .$themenreihenfolge[0]. '.';
	// Antwortvariable vorbereiten - momentan natürlich leer!
	// $_SESSION['thema0_antwort'] = '';
	// Zitatreihenfolge für dieses Thema generieren; selbes Vorgehen wie bei der Themenreihenfolge
	// Beispiel $k = 2;
	// $_SESSION['thema0_zitat2'] = $zitatreihenfolge-Array[2];

	// Themenauswahl
	$_SESSION['themenreihenfolge'].= '' .$themenreihenfolge[$i]. '.';
	
	$_SESSION['thema' .$i. '_antwort'] = '';

	// Bestimmung der Zitatreihenfolge abhängig von Parteienanzahl	
	$zitatreihenfolge = UniqueRandomNumbersWithinRange( 1, 6, 6 );

	for ( $k = 0; $k <= 5; $k++ ) {

		// Zitatauswahl
		$_SESSION['thema' . $i . '_zitat' . ( $k ) . ''] = $zitatreihenfolge[ $k ];
			
	}	
}

// letzten in Zeile 37 hinzugefügten . entfernen
$_SESSION['themenreihenfolge'] = substr($_SESSION['themenreihenfolge'], 0, -1);	

?>