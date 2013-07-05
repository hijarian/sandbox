<?php
function convertStringsToMultiArrayByColumns(
	$strings,
	$columns_number
) {
	if (!$strings) {
		return array();
	}

	$input_as_array = explode("\n", trim($strings));
	$column_length = intval(ceil(count($input_as_array) / $columns_number));

	$result = array();
	$column = array();
	$counter = 0;
	foreach ($input_as_array as $string) {
		++$counter;
		$column[] = $string;

		if ($counter == $column_length) {
			$result[] = $column;
			$column = array();
			$counter = 0;
		}
	}
	if ($column) {
		$result[] = $column;
	}
	return $result;
}
