<?php
# Prevent a 406 being sent when there is no match for the user's
# Accept-Language available. Instead, send the English version.

# It would be better to use a file from the Alternates
# response-header, but apache_response_headers() is only available
# in PHP 4.3.0 or later.

$f = substr($_SERVER["REQUEST_URI"], 1);
if (substr($f, -1) == "/" or $f == "")
    $f .= "index";
$f .= ".en";

header("HTTP/1.1 200 OK");
header("Content-Location: " . $f);
header("Last-Modified: " . gmdate("D, d M Y H:i:s ", filemtime($f)) . "GMT");
header("Content-Length: " . filesize($f));
header("Content-Language: en");
readfile($f);
?>
