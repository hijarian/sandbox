<?php
	$money = 10.0;
	for ($i = 0;$i < 1000; ++$i)
	{
		$money /= 10;
		$money *= 10;
	}
echo $money;
?>
