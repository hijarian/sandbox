<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тест веб-приложения");
?>

<?php
$finfo = new finfo(FILEINFO_MIME); 

if (!$finfo) {
    echo "Opening fileinfo database failed";
}
else
{
	print '<table border="1" cellspacing="0">';
	print '<tr>';
	print '<th>#</th><th>Name</th><th>Type</th><th>Size</th>';
	print '</tr>';
	$index = 1;
	$filedir = $_SERVER['DOCUMENT_ROOT']."/upload/fileinfo_test/";
	foreach (glob($filedir.'*.*') as $filepath)
	{
		$filename = basename($filepath);
		printf ("<tr><td>%d</td><td>%s</td><td>%s</td><td>%s bytes length</td></tr>", $index, $filename, $finfo->file($filepath), filesize($filepath));
		++$index;
	}
	print '</table>';
}
?>

<?php require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>