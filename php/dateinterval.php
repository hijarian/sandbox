<?php
	new DateInterval('-P2D'); // Exception
//	var_dump($di);
	
	$di = new DateInterval('P2D'); // Correct
	$di->invert = 1;
	var_dump($di);
?>
