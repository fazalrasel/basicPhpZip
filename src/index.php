<?php
function createZip($files = array(), $destination = '', $overwrite = false)
{

    if (file_exists($destination) && !$overwrite) {
        return false;
    }
    $valid_files = array();
    if (is_array($files)) {
        foreach ($files as $file) {
            if (file_exists($file)) {
                $valid_files[] = $file;
            }
        }
    }
    if (count($valid_files)) {
        $zip = new ZipArchive();
        if ($zip->open($destination, $overwrite ? ZipArchive::OVERWRITE : ZipArchive::CREATE) !== true) {
            return false;
        }
        foreach ($valid_files as $file) {
            $zip->addFile($file, $file);
        }
        $zip->close();

        return file_exists($destination);
    } else {
        return false;
    }
}

$fileList = array(
    'files/file1.txt',
    'files/file2.txt',
);

$result = createZip($fileList, 'files.zip');
if ($result == true) {
    echo 'Success';
} else {
    echo 'Fail';
}