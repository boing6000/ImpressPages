# ImpressPages

ImpressPages is a php framework with user friendly drag & drop CMS.

## Install from GIT

1. execute the following commands in the command line
   - git clone git@github.com:impresspages/ImpressPages.git your_web_server_folder
   - cd your_web_server_folder
   - composer install
2. Visit your web server in the browser.
3. Follow the onscreen instructions.

## Install from ZIP

1. Visit the [ImpressPages website] (http://www.impresspages.org) to download the latest version of ImpressPages
2. Extract & upload all folders and files to the server.
3. Make sure you don't forget .htaccess file as it is hidden on Mac and Linux by default
4. Visit your web server in the browser.
5. Follow the onscreen instructions.

## Update from GIT

1. Backup the database
2. git pull https://github.com/impresspages/ImpressPages.git master

## Update using admin panel (if you have installed from ZIP)

1. Backup all your files and the database.
2. Point your browser to ImpressPages administration panel (`admin.php`), and log in.
3. Go to `Administrator -> System` tab, and check for update instructions in `System messages` area. Click the `Start update` button. Follow the onscreen instructions.
4. If you use GIT, commit all changes made by the update.
