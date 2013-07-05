<?php
	$timestamp = 0;
	print date('Y-m-d H:i:s', $timestamp)."\n";
	
	$dates = array(
		array('2002-10-03', '2005-05-07'),
		array('1986-04-25', '1999-02-19'),
		array('1910-01-01', '2011-12-12'),
		array('2010-10-03', '2011-05-07'),
	);

	foreach($dates as $date_array)
	{
		$diff = date_diff(new DateTime($date_array[0]), new DateTime($date_array[1]));
		echo $diff->format('%y')."\n";
	}
?>
