# README

This is the web-opt.com repo. Please be polite and respectful to the elderly.

## Server

Please do not use password. Use rsa keys to connect to the server.

Once on the server, please make sure to switch to www user, and only use root for exceptional cases.

### Server Notes:

There are 3 users to get introduced to: www, www-data, and root.

* **www** is the user you should be using most of the time. Home is /home/www folder.
* **www-data** is the server (nginx) user. Home is /var/www folder. (Yes strange, so be careful with git tracking as it tends to create things in there, e.g. .bash_history). Both www and www-data users are in the www-data *group*, so in general it's a good idea to give all files in the /var/www folder www-data's group perminssions (see the Server Commands section below).
* **root** is root [duh]

### Server Commands:

Change the owner of the whole /var/www folder to www and group to www-data (www user is part of the www-data group, so it's ok):

`chown -R www:www-data /var/www`

Change permissions of the /var/www folder to be editable by the owner and group.

`chmod 2775 /var/www`

Change permissions of all folders inside of the /var/www folder.

`find /var/www -type d -exec chmod 2775 {} \;`

Change permissions of all files inside of the /var/www folder.

`find /var/www -type f -exec chmod 0664 {} \;`

## Set up

* git clone
* composer install
* download and adjust the .env file. It's on the server but not git tracked. Contact me for questions.

## Contact

* geo.artemenko@gmail.com
* kirill@artemenko.info