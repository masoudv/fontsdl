<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Font Downloader</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="container">
        <h2>Font Downloader</h2>
        <form id="fontForm">
            <label for="cssUrl">CSS File URL:</label>
            <input type="text" id="cssUrl" name="cssUrl" required placeholder="https://example.com/style.css">
            
            <label for="baseUrl">Base Site URL:</label>
            <input type="text" id="baseUrl" name="baseUrl" required placeholder="https://example.com">
            
            <label for="themeName">Theme Name:</label>
            <input type="text" id="themeName" name="themeName" required placeholder="theme-name">

            <button type="submit" id="downloadButton">Start Download</button>
        </form>

        <div id="logContainer">
            <h3>Logs</h3>
            <div id="log"></div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
