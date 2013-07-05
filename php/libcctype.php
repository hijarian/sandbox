<?php
class CreditCardType
{
    private static $card_type_regexes = array(
        '/^4[0-9]{12}(?:[0-9]{3})?$/' => 'VISA',
        '/^5[1-5][0-9]{14}$/' => 'MasterCard',
        '/^3[47][0-9]{13}$/' => 'American Express',
        '/^3(?:0[0-5]|[68][0-9])[0-9]{11}$/' => 'Diners Club',
        '/^6(?:011|5[0-9]{2})[0-9]{12}$/' => 'Discover',
        '/^(?:2131|1800|35\d{3})\d{11}$/' => 'JCB'
    );

    public static function getFromNumber($ccnum)
    {
        if (!$ccnum)
            throw new InvalidArgumentException('Empty Credit Card Number given!');

        foreach (self::$card_type_regexes as $regexp => $cctype)
            if (preg_match($regexp, $ccnum))
                return $cctype;

        return false;
    }
}
