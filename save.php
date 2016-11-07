<?php

$selecteds = isset($_POST['images']) ? $_POST['images'] : [];

if (is_array($selecteds)) {

    $zip = new ZipArchive();

    $filename = __DIR__ . "/temp/" . uniqid() . ".zip";

    if ($zip->open($filename, ZIPARCHIVE::CREATE) !== TRUE) {

        exit("cannot open <$filename>\n");
    }

    foreach ($selecteds as $key => $selected) {
        if ($selected === 'checked') {
            $zip->addFromString(time() . ".{$key}.txt", "#1 This is a test string added as testfilephp.txt.\n");
            //$zip->addFile($thisdir . "/too.php","/testfromfile.php");
        }
    }

    $zip->close();
    
    download($filename);
}

function download($filename) 
{
    header('Content-Description: File Transfer');
    header('Content-Disposition: attachment; filename="'. basename($filename) .'"');
    header('Content-Type: application/octet-stream');
    header('Content-Transfer-Encoding: binary');
    header('Content-Length: ' . filesize($filename));
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('Pragma: public');
    header('Expires: 0');
    // Envia o arquivo para o cliente
    readfile($filename);
}