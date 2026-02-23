# Web-Opt.com — AGENTS.md

This is the master infrastructure reference for all 3 projects hosted on the same server.

## Shared Infrastructure

- **Server**: DigitalOcean droplet, Ubuntu 24.04 LTS, 1GB RAM, NYC3
- **IP**: 138.197.10.167
- **SSH**: `ssh geo@web-opt.com`
- **Node.js**: v24 LTS via NVM
- **Web Server**: Nginx (auto-starts on reboot)
- **SSL**: Let's Encrypt via Certbot (auto-renew)
- **DNS**: DigitalOcean nameservers
- **Backups**: Weekly, Thu 4am UTC

### Hosted Sites

| Site | Repo | Branch | Tech | Server Path |
|------|------|--------|------|-------------|
| web-opt.com | `git@bitbucket.org:Geo4orce/web-opt.com.git` | `main` | Laravel 8 + PHP 8.3 + Mix | `/var/www/web-opt.com` |
| gdice.cc | `git@bitbucket.org:Geo4orce/gdice.git` | `main` | Vue 3 + Vite | `/var/www/gdice` |
| ezspell.com | `git@bitbucket.org:Geo4orce/ezspell.git` | `main` | Svelte + Webpack | `/var/www/ezspell` |

### SSH Keys (on server)

| Key | Purpose |
|-----|---------|
| `bitbucket_ed25519` | web-opt.com repo access |
| `bitbucket4_ed25519` | ezspell repo access |
| `id_ed25519` | gdice repo access (geoar@GEO_PC) |

---

## Web-Opt.com — Project Details

- **Domain**: https://web-opt.com/
- **Tech Stack**: Laravel 8 + PHP 8.3-FPM + Laravel Mix (Webpack) + SCSS

### Deploy
```bash
ssh geo@web-opt.com
cd /var/www/web-opt.com
git pull origin main
composer install --no-dev --optimize-autoloader
php artisan config:cache
php artisan route:cache
php artisan view:cache
npm install && npm run prod
sudo nginx -t && sudo systemctl reload nginx
```

### Local Dev
```bash
npm install
composer install
php artisan serve
npm run watch
```

### Conventions
- **.env values**: Always use double quotes. For booleans use `"1"` (true) or `""` (false).
  ```
  APP_ENV="production"
  APP_DEBUG=""
  APP_KEY="base64:..."
  DB_CONNECTION="sqlite"
  ```

### Notes
- Simple brochure site (1 page + contact form email endpoint)
- No database needed — use `DB_CONNECTION="sqlite"` or remove DB config
- Contact form: POST /api/contact-us → sends email via SMTP
- Dev dependencies (ide-helper, debugbar) guarded by `APP_ENV !== production`
