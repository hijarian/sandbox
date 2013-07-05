<?php
$mongo = new Mongo();
$db = $mongo->selectDB('local');

$result = $db->test->update(
	array('name' => 'banner'),
	array('$set' => array('data' => 'Mark Was Here!')),
	array('upsert' => false, 'safe' => true)
);

print_r($result);

