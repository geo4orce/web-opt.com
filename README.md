# README

This is the web-opt.com repo. Please be polite and respectful to the elderly.

## Server

Please do not use password. Use rsa keys to connect to the server.

Once on the server, please make sure to switch to www user, and only use root for exceptional cases.

### Server Notes:

There are 3 users to get introduced to: www, www-data, and root.

* **www** is the user you should be using most of the time. Home is /var/www folder (not /home/www even though it exists!). Yes, this is strange, so be careful with git tracking as things may get created in this home dir, e.g. a .bash_history file or .cache folder.
* **www-data** is the server (nginx) user. You cannot `su` into this user though. Home is /var/www/laravel/public folder. Both www and www-data users are in the www-data *group*, so in general it's a good idea to make sure that all files in the /var/www folder have www-data's group permissions for read and write (see the Server Commands section below).
* **root** is root [duh]

### Server Commands:

Pull from BitBucket (please make sure to switch to www user first: `su www`!)

`cd /var/www/laravel && git pull`

Change the owner of the whole /var/www/laravel folder to www and group to www-data (www user is part of the www-data group, so it's ok):

`chown -R www:www-data /var/www/laravel`

Change permissions of the laravel folder to be editable by the owner and group.

`chmod 2775 /var/www/laravel`

Change permissions of all folders inside of the laravel folder.

`find /var/www/laravel -type d -exec chmod 2775 {} \;`

Change permissions of all files inside of the laravel folder.

`find /var/www/laravel -type f -exec chmod 0664 {} \;`

## Set up

* git clone
* composer install
* download and adjust the .env file. It's on the server but not git tracked. Contact me for questions.

## Contact

* geo.artemenko@gmail.com
* kirill@artemenko.info