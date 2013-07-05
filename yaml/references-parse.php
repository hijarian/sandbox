<?php
// Load file `references.yml` into memory
$datafilename = realpath(__DIR__.'/references.yml');
$cardata = yaml_parse_file($datafilename);
print_r($cardata);