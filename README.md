# magento2-simplebanner
Simple Banner Module for Magento 2. This module adds a banner in the front end. The user can make groups of images and configure a banner for each group.
The banner can be added through a widget.

# Creating Project with Composer

Next you need to install your Magento project inside the web container under the /var/www/magento2 directory. (Apache is configured by default to use /var/www/magento2 as the document root.) There are multiple options here.

Note: The first time you run Composer in the following steps, it may prompt you for a username and password. Enter your 'public' and 'private' keys from http://marketplace.magento.com/, "My Profile", "Access keys" when prompoted. Be aware that an auth.json file holding your keys will be saved into ~/.composer/. If you want to share the Composer downloaded files but have a different auth.json file per project, move the auth.json file into your project's home directory (/var/www/magento2). Most people add the auth.json file to their .gitignore file to avoid accental sharing of the keys.

Log into the web container.
Create a new project under /var/www/magento2 using the Composer "create-project" command. Update the project edition and version number as appropriate. This example uses Magento Open Source (formerly "Community Edition") version 2.2.0.

    cd /var/www/magento2
    composer create-project --repository=https://repo.magento.com/ magento/project-community-edition:2.2.0 .
    chmod +x bin/magento


    php bin/magento cache:clean
    php bin/magento cache:flush
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile

And

    php bin/magento setup:static-content:deploy
    php bin/magento indexer:reindex

# Module Gonza Banner. Copy from "module" to "magento2\app\code"

List all active and inactive modules

        php bin/magento module:status

Find module name, and use this to enable it

        php bin/magento module:enable Gonza_Banner
        php bin/magento setup:upgrade
        php bin/magento setup:di:compile


