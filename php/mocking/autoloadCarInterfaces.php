<?php

foreach (glob(dirname(__FILE__) . '/CarInterface/*.php') as $filename)
{
    if (is_file($filename))
    {
        require_once $filename;
    }
}
