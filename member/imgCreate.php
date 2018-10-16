<?php
function getLatestImage($folderName, $imageEnding) {
    $newest_mtime = 0;
    $base_url = ''.$folderName;
    $file_ending = $imageEnding;
    $show_file = 'images/folio/no-image.jpg';
    if ($handle = opendir($base_url)) {
        while (false !== ($latestFile = readdir($handle))) {
            if (($latestFile != '.') && ($latestFile != '..') && ($latestFile != '.htaccess') && (strpos($latestFile, $file_ending))) {
                $mtime = filemtime("$base_url/$latestFile");
                if ($mtime > $newest_mtime) {
                    $newest_mtime = $mtime;
                    $show_file = "$base_url/$latestFile";
                }
            }
        }
    }
    return $show_file;
}
?>