<?php

function getCssContent($cssUrl) {
    $cssContent = @file_get_contents($cssUrl);
    if ($cssContent === false) {
        die("Error: Failed to retrieve CSS file from $cssUrl\n");
    }
    return $cssContent;
}

function findFontUrls($cssContent, $baseUrl, $themeDir) {
    $fontUrls = [];
    preg_match_all('/url\(["\']?(.*?)["\']?\)/', $cssContent, $matches);

    foreach ($matches[1] as $url) {
        // Check if the URL is relative or absolute
        if (parse_url($url, PHP_URL_SCHEME) === null) {
            // Handle relative URLs
            $url = rtrim($baseUrl, '/') . '/' . rtrim($themeDir, '/') . '/' . ltrim($url, '/');
        } else {
            $url = $url; // URL is absolute
        }
        $fontUrls[] = $url;
    }

    return array_unique($fontUrls); // Remove duplicate URLs
}

function downloadAndZipFonts($fontUrls, $zipFilePath) {
    $zip = new ZipArchive();
    
    if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
        exit("Cannot open <$zipFilePath>\n");
    }

    foreach ($fontUrls as $fontUrl) {
        $fontContent = @file_get_contents($fontUrl); // Use @ to suppress warnings
        if ($fontContent !== false) {
            $fontFileName = basename(parse_url($fontUrl, PHP_URL_PATH));
            $zip->addFromString($fontFileName, $fontContent);
        } else {
            echo "Failed to download: $fontUrl\n";
        }
    }

    $zip->close();
}

// FUll CSS link with site address and theme name
$cssUrl = 'https://domain-name.com/wp-content/themes/theme-name/fonts/fonts.css?ver=6.6.1';
$baseUrl = 'https://domain-name.com';
$themeDir = 'wp-content/themes/theme-name/fonts';
$zipFilePath = 'fonts.zip'; //Zip file name after grab fonts

$cssContent = getCssContent($cssUrl);
$fontUrls = findFontUrls($cssContent, $baseUrl, $themeDir);
downloadAndZipFonts($fontUrls, $zipFilePath);

echo "Fonts have been downloaded and zipped to $zipFilePath\n";
?>
