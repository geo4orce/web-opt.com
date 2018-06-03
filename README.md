# Web-Opt

This is the web-opt.com repo. Please be polite and respectful to the elderly.

## Login to Server

Password ssh is disabled. Use ssh keys to connect to the server:

`ssh -i ~/.ssh/id_rsa geo@web-opt.com`

Once inside the server, switch to **www-data** user (no password needed) to edit the web files:

`sudo -su www-data`

If ever need root actions (password required), do:

`sudo su -`

## Server Commands (as www-data user)

Pull from BitBucket repo, prod from master branch:

`git -C /var/www/web-opt.com pull`

stage from develop branch:

`git -C /var/www/stage.web-opt.com pull`

## Troubleshooting

If ever issues, try doing this **as root** (may take a bit):

### prod

```
chown -R www-data:www-data /var/www/web-opt.com && \
chmod 2755 /var/www/web-opt.com && \
find /var/www/web-opt.com -type d -exec chmod 2755 {} \; && \
find /var/www/web-opt.com -type f -exec chmod 0644 {} \; && \
cd /var/www/web-opt.com && \
chmod -R 777 bootstrap/cache storage
```

### stage

```
chown -R www-data:www-data /var/www/stage.web-opt.com && \
chmod 2755 /var/www/stage.web-opt.com && \
find /var/www/stage.web-opt.com -type d -exec chmod 2755 {} \; && \
find /var/www/stage.web-opt.com -type f -exec chmod 0644 {} \; && \
cd /var/www/stage.web-opt.com && \
chmod -R 777 bootstrap/cache storage
```

## Local or stage set up

* `git clone`
* `php artisan env` --> should be "local" or "staging"
* `composer install`
* `php artisan clear-compiled`
* `php artisan cache:clear`
* `php artisan config:clear`
* `php artisan route:clear`
* `php artisan view:clear`

## Deployment

* `composer install --optimize-autoloader --no-dev`
* `php artisan config:cache`
* `php artisan route:cache`
* `php artisan queue:restart`

## Contact

* [geo@web-opt.com](mailto:geo@web-opt.com)
* [kirill@artemenko.ru](mailto:kirill@artemenko.ru)
