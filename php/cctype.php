#!/usr/bin/php
<?php
require(__DIR__.'/libcctype.php');


$ccnum = '';
if ($argc === 1)
{
    echo "Credit card number: ";
    $ccnum = trim(fgets(STDIN));
}
else
{
    $ccnum = $argv[1];
}


echo ($cctype = CreditCardType::getFromNumber($ccnum))
    ? $cctype
    : "Unknown type";

