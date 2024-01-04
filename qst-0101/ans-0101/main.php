<?php

$filePath = $argv[1];

$fileContent = file_get_contents($filePath);

$pattern = '/(https?:\/\/[^\s]+)/';

preg_match_all($pattern, $fileContent, $matches);

$urlArray = !empty($matches[0]) ? $matches[0] : [];
$urlArray = array_unique($urlArray);

foreach ($urlArray as $url) {
    $cleanedUrl = str_replace(["'", '"', '</script>', '</a>', '>'], '', $url)."\n";
    echo $cleanedUrl;
}
?>

