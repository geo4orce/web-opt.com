# Web-Opt.com - Development & Deployment Information

## Repository
- **Code**: Bitbucket (origin) - git@bitbucket.org:Geo4orce/web-opt.com.git
- **Domain**: https://www.web-opt.com/
- **Tech Stack**: Laravel 8 + PHP 8.3 + Laravel Mix (Webpack) + SCSS

## Server Access
- **Server**: web-opt.com (SSH: geo@web-opt.com)
- **IP**: 138.197.10.167
- **SSH Key**: bitbucket_ed25519 (geo@web-opt server)
- **Node.js**: v22 LTS (via NVM)
- **PHP**: 8.3-FPM
- **Web Server**: Nginx + PHP-FPM

## Deployment Commands
```bash
ssh geo@web-opt.com
cd /var/www/web-opt.com
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm install && npm run production
sudo nginx -t && sudo systemctl reload nginx
```

## Local Development
```bash
npm install
composer install
php artisan serve
npm run watch
```

## Conventions
- **.env values**: Always use double quotes. For booleans use `"1"` (true) or `""` (false).
  ```
  APP_ENV="production"
  APP_DEBUG=""
  APP_KEY="base64:..."
  DB_CONNECTION="sqlite"
  ```

## Notes
- Simple brochure site (1 page + contact form email endpoint)
- No database needed — use `DB_CONNECTION="sqlite"` or remove DB config
- Contact form: POST /api/contact-us → sends email via SMTP
- Dev dependencies (ide-helper, debugbar) guarded by `APP_ENV !== production`
