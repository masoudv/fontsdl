<?php

header('Content-Type: application/json');

function getCssContent($cssUrl) {
    $cssContent = @file_get_contents($cssUrl);
    if ($cssContent === false) {
        return ['success' => false, 'message' => "Failed to retrieve CSS file from $cssUrl"];
    }
    return $cssContent;
}

function findFontUrls($cssContent, $baseUrl, $themeDir) {
    $fontUrls = [];
    preg_match_all('/url\(["\']?(.*?)["\']?\)/', $cssContent, $matches);

    foreach ($matches[1] as $url) {
        if (parse_url($url, PHP_URL_SCHEME) === null) {
            $url = rtrim($baseUrl, '/') . '/' . rtrim($themeDir, '/') . '/' . ltrim($url, '/');
        }
        $fontUrls[] = $url;
    }

    return array_unique($fontUrls);
}

function downloadAndZipFonts($fontUrls, $zipFilePath) {
    $zip = new ZipArchive();
    $logs = [];

    if ($zip->open($zipFilePath, ZipArchive::CREATE) !== TRUE) {
        return ['success' => false, 'message' => "Cannot open <$zipFilePath>"];
    }

    foreach ($fontUrls as $fontUrl) {
        $fontContent = @file_get_contents($fontUrl);
        if ($fontContent !== false) {
            $fontFileName = basename(parse_url($fontUrl, PHP_URL_PATH));
            $zip->addFromString($fontFileName, $fontContent);
            $logs[] = ['success' => true, 'message' => "Successfully downloaded: $fontUrl"];
        } else {
            $logs[] = ['success' => false, 'message' => "Failed to download: $fontUrl"];
        }
    }

    $zip->close();
    return ['success' => true, 'zipFile' => $zipFilePath, 'logs' => $logs];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cssUrl = $_POST['cssUrl'];
    $baseUrl = $_POST['baseUrl'];
    $themeName = $_POST['themeName'];
    $themeDir = 'wp-content/themes/' . $themeName;
    $zipFilePath = 'fonts.zip';

    $cssContent = getCssContent($cssUrl);
    if (is_array($cssContent)) {
        echo json_encode($cssContent);
        exit;
    }

    $fontUrls = findFontUrls($cssContent, $baseUrl, $themeDir);
    $result = downloadAndZipFonts($fontUrls, $zipFilePath);
    echo json_encode($result);
    exit;
}
?>
