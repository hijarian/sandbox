<?php
$date_from = new DateTime('2012-01-01');
$date_to = new DateTime('2010-01-01');
$diff= date_diff($date_from, $date_to);
var_dump($diff);