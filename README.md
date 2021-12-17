# Web-Opt

This is the web-opt.com repo. Please be polite and respectful to the elderly.

## Login to Server

Password ssh is disabled. Use ssh keys to connect to the server:

`ssh -i ~/.ssh/id_rsa geo@web-opt.com`

Once inside the server, switch to **www-data** user (no password needed) to edit the web files:

`sudo -su www-data`

and go to prod folder:

`cd /var/www/web-opt.com`

or stage:

`cd /var/www/stage.web-opt.com`

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

### misc

When starting a droplet it hangs on boot:

1. Go to the [Recovery Console](https://cloud.digitalocean.com/droplets/9476819/access?i=552704).
2. Press the `Launch Recovery Console` button.
3. Click on the console and ?? press "Enter" about two times. Something like that.
4. It should start booting at this point.
5. Check the website in a bit.

PHP is not starting after droplet reboot (@todo: fix it in the startup list `ls /etc/rc*.d` - S01=start, K01=kill):
```
php -v
update-alternatives --config php # change PHP version
service php7.2-fpm status
service php7.2-fpm restart
systemctl status php*-fpm.service # list all php-fpm installed
```

Check/restart nginx:
```
nginx -v
nginx -t # check valid configs
systemctl restart nginx
systemctl status nginx
tail -f /var/log/nginx/error.log
tail -f /var/log/nginx/access.log
```

Turn off apache autostart, enable nginx (not 100% sure):
```
update-rc.d apache2 disable
systemctl enable nginx
```

### local

if issues with env vars or debugbar is not showing up:

```
# stop the local server
php artisan clear-compiled
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
# start the local server
```

## Local or stage set up

* `nvs use` --> [nvs](https://github.com/jasongin/nvs) will read the .node-version file 
* `node -v` --> should be `v16.13.1`
* `npm -v` --> should be `8.1.2`
* If `php -v` is not 8, then run `composer run php8`
* `php artisan env` --> should be "local" or "stage"
* `composer install`
* `php artisan clear-compiled`
* `php artisan cache:clear`
* `php artisan config:clear`
* `php artisan route:clear`
* `php artisan view:clear`
* `npm install`
* `npm run dev` or `npm run watch`
* `composer run serve` --> http://localhost:8000/ or 8001 (watch out for reason: Address already in use) 

## Deployment

Before committing into master run:
* `composer run test` --> make sure phpunit is all green
* `npm run test` --> make sure jest is all green (@todo: not yet implemented)
* `npm run prod` --> this will minify and cache-bust the bundles
* Then commit and push.

Then on **stage** server run:
* `cd /var/www/stage.web-opt.com` 
* `git pull`
* `composer install` 

On **prod**:
* `cd /var/www/web-opt.com`
* @todo: consider `php artisan down` before doing this?
* `git pull`
* `composer install --optimize-autoloader --no-dev`
* `php artisan config:cache`
* `php artisan route:cache`
* `php artisan queue:restart`

NOTE: consider putting the server into a maintenance mode meanwhile:
```
php artisan down
php artisan up
```

## Contact

* [geo@web-opt.com](mailto:geo@web-opt.com)
