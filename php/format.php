<?php
$html = '
<html>
<body>
<div>

<div>

        <div>

                <p>My Last paragraph</p>
            <div>
                            This is another text block and some other stuff.<br><br>
                Again we will start a new paragraph
                            and some other stuff
                            <br>
        </div>
</div>
        <div>
                        <div>
                            <h1>Another Title</h1>
                                                    </div>
                        <p>Some text again <b>for sure</b></p>
                </div>
</div>
</div>
</body>
</html>';

header('Content-Type: text/plain');
libxml_use_internal_errors(TRUE);

$html = preg_replace('/>\s*</im', '><', $html);
print $html;
$dom = new DOMDocument;
$dom->loadHTML($html);
$dom->formatOutput = true;
$dom->preserveWhitespace = false;
print $dom->saveXML();
?>
