<?php

$filePath = $argv[1];

$fileContent = file_get_contents($filePath);

$pattern = '/(https?:\/\/[^\s]+)/';

preg_match_all($pattern, $fileContent, $matches);

$urlArray = !empty($matches[0]) ? $matches[0] : [];
$urlArray = array_unique($urlArray);

$groupUrls = [];
foreach ($urlArray as $url) {
    $cleanedUrl = str_replace(["'", '"', '</script>', '</a>', '>'], '', $url)."\n";
    $urlParts = parse_url($cleanedUrl);
    $groupKey = $urlParts['scheme'].'.//'.$urlParts['host'];
    $groupUrls[$groupKey][] = $cleanedUrl;
}
foreach ($groupUrls as $group => $urls) {
    $count = count($urls);
    echo "origin=$group total=$count\n";
    foreach ($urls as $url) {
        echo "$url";
    }
    echo "\n";
}

?>

