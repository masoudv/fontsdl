# PHP Font Downloader and Zipper

This PHP script is designed to download all font files referenced in a given CSS file and package them into a ZIP archive. It is particularly useful for WordPress themes where fonts are referenced with relative paths.

## How It Works

1. **Fetch CSS Content:**  
   The script first downloads the CSS file from the provided URL using `file_get_contents()`. If the CSS file cannot be retrieved, an error message is displayed.

2. **Extract Font URLs:**  
   The script then scans the CSS content for `url()` references to fonts. It checks whether these URLs are relative or absolute:
   - **Relative URLs:** These are converted to absolute URLs using the base URL of the website and the path to the theme directory.
   - **Absolute URLs:** These are used as-is.

3. **Download and Zip Fonts:**  
   The script downloads each font file from the extracted URLs. If the download is successful, the font is added to a ZIP archive. Any failed downloads are logged in the output.

4. **Create ZIP File:**  
   Finally, all successfully downloaded fonts are zipped into a file named `fonts.zip`.

## Example Configuration

To use the script, follow these steps:

1. **Access the Form:**  
   Open `index.php` in a web browser to see the form.

2. **Fill in the Form:**
   - **CSS File URL:** Enter the full URL to the CSS file that contains the font references. For example:
     ```
     https://domain-name.com/wp-content/themes/theme-name/fonts/fonts.css?ver=6.6.1
     ```
   - **Base Site URL:** Enter the base URL of your website. For example:
     ```
     https://domain-name.com
     ```
   - **Theme Name:** Enter the name of the WordPress theme you are using. The script will automatically prepend `wp-content/themes/` to this name. For example:
     ```
     theme-name
     ```

3. **Start Download:**
   - Click the **"Start Download"** button to begin the process. The button will be disabled during the download.

4. **Check Logs:**
   - As the script processes, logs will appear below the form. Successful downloads will be shown in green, and failed attempts will be shown in red. 

5. **Download ZIP File:**
   - Once the download is complete, a link to download the ZIP file containing the fonts will appear in the logs. Click this link to download the ZIP file.
 


### Result

After filling in the form and clicking the **"Start Download"** button, the script will process the CSS file, download the fonts, and package them into a ZIP file. The log area will show which fonts were successfully downloaded and which ones failed. Finally, a link to download the ZIP file will be provided.



This project is licensed under the MIT License - see the LICENSE file for details.
