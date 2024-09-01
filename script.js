document.getElementById('fontForm').addEventListener('submit', function(e) {
    e.preventDefault();

    // Get form data
    const cssUrl = document.getElementById('cssUrl').value;
    const baseUrl = document.getElementById('baseUrl').value;
    const themeName = document.getElementById('themeName').value;
    const downloadButton = document.getElementById('downloadButton');
    const logContainer = document.getElementById('log');

    // Disable the form and button
    downloadButton.disabled = true;
    logContainer.innerHTML = '<p>Downloading started...</p>';

    // Create FormData object
    const formData = new FormData();
    formData.append('cssUrl', cssUrl);
    formData.append('baseUrl', baseUrl);
    formData.append('themeName', themeName);

    // Send AJAX request
    fetch('download_fonts.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        data.logs.forEach(log => {
            const logElement = document.createElement('p');
            logElement.textContent = log.message;
            logElement.style.color = log.success ? 'green' : 'red';
            logContainer.appendChild(logElement);
        });

        if (data.success) {
            const downloadLink = document.createElement('a');
            downloadLink.href = data.zipFile;
            downloadLink.textContent = 'Download ZIP';
            downloadLink.className = 'download-link';
            logContainer.appendChild(downloadLink);
        } else {
            logContainer.innerHTML += '<p class="error">Error: ' + data.message + '</p>';
        }
    })
    .catch(error => {
        logContainer.innerHTML += '<p class="error">Error: ' + error.message + '</p>';
    })
    .finally(() => {
        downloadButton.disabled = false;
    });
});
