<?php
class Demo
{
  public function getFactor($value)
  {
    return $value * 2;
  }
}

$values = array(1, 3, 5, 7);

// Holy crap, I can map with class methods!
print_r(array_map(array('Demo', 'getFactor'), $values));
