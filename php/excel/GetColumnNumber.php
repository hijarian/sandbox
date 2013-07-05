<?php
/**
 * Convert zero-based column number to Excel worksheet column name
 * e. g. column 0 would be "A", column 26 would be "AA" and so on.
 *
 * @param int $columnNumber Zero-based column number.
 * @param string Name of column in Excel worksheet notation (which can be one or more letters from A to Z).
 */
function getExcelColumnName($columnNumber)
{
    $dividend = $columnNumber + 1;
    $columnName = '';
    $modulo = null;

    while ($dividend > 0)
    {
        $modulo = ($dividend - 1) % 26;
        $columnName = chr(65 + $modulo) . $columnName;
        $dividend = (int)(($dividend - $modulo) / 26);
    } 

    return $columnName;
}
