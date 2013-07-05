<?php
$date_from = new DateTime('2011-11-17');
$date_to = new DateTime('now');

$diff = date_diff($date_from, $date_to);

echo $diff->format('%m месяцев, %d дней');

?>
