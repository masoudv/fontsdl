# fontsdl
PHP Script: Download and Zip Fonts from a CSS File
PHP Font Downloader and Zipper

This PHP script is designed to download all font files referenced in a given CSS file and package them into a ZIP archive. It is beneficial for WordPress themes where fonts are referenced with relative paths.
How It Works

    Fetch CSS Content:
    The script first downloads the CSS file from the provided URL using file_get_contents(). An error message is displayed if the CSS file cannot be retrieved.

    Extract Font URLs:
    The script then scans the CSS content for url() references to fonts. It checks whether these URLs are relative or absolute:
        Relative URLs: These are converted to absolute URLs using the base URL of the website and the path to the theme directory.
        Absolute URLs: These are used as-is.

    Download and Zip Fonts:
    The script downloads each font file from the extracted URLs. If the download is successful, the font is added to a ZIP archive. Any failed downloads are logged in the output.

    Create ZIP File:
    Finally, all successfully downloaded fonts are zipped into a file named fonts.zip.

Configuration

Update the following variables in the script to match your environment:

    $cssUrl: The full URL to the CSS file containing the font references.
    $baseUrl: The base URL of your website.
    $themeDir: The relative path to the theme directory where the CSS file is located.
    $zipFilePath: The name of the output ZIP file.

Example Configuration

php

$cssUrl = 'https://your-domain/wp-content/themes/your-theme-name/fonts/fonts.css?ver=6.6.1';
$baseUrl = 'https://your-domain';
$themeDir = 'wp-content/themes/your-theme-name';
$zipFilePath = 'fonts.zip';

This configuration will download the fonts referenced in the fonts.css file from the "Hub" WordPress theme on the tabdil.com website and save them in a ZIP file named fonts.zip.
Usage

    Place the script in a PHP environment.
    Configure the variables according to your needs.
    Run the script.

The fonts will be downloaded and compressed into a ZIP archive in the same directory as the script.
License

This project is licensed under the MIT License - see the LICENSE file for details.
