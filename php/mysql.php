<?php

$db = mysql_connect('localhost', 'root', 'mysqlroot');
if (!$db) {
    die('Not connected : ' . mysql_error());
}

$db_selected = mysql_select_db('olis-dev', $db);
if (!$db_selected) {
    die ('Can\'t use u: ' . mysql_error());
}

$result = mysql_query('select login from u', $db);
while ($row = mysql_fetch_array($result, MYSQLI_ASSOC))
{
	$data[] = $row['login'];
}
$string_result = '"'. implode('", "', $data) . '"';
echo $string_result;
mysql_close($db);

?>
