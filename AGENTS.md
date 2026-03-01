# Web-Opt.com — AGENTS.md

This is the master infrastructure reference for all 3 projects hosted on the same server.

## Shared Infrastructure

- **Server**: DigitalOcean droplet, Ubuntu 24.04 LTS, 1GB RAM, NYC3
- **IP**: 138.197.10.167
- **SSH**: `ssh geo@web-opt.com` (admin), `deploy` user (restricted, deploy only)
- **Web Server**: Nginx (auto-starts on reboot)
- **PHP**: 8.3-FPM + Composer (web-opt.com only)
- **SSL**: Let's Encrypt via Certbot (auto-renew)
- **DNS**: DigitalOcean nameservers
- **Backups**: Weekly, Thu 4am UTC

### Hosted Sites

| Site | Repo | Branch | Tech | Server Path |
|------|------|--------|------|-------------|
| web-opt.com | `git@bitbucket.org:Geo4orce/web-opt.com.git` | `main` | Laravel 8 + PHP 8.3 + Mix | `/var/www/web-opt.com` |
| gdice.cc | `git@bitbucket.org:Geo4orce/gdice.git` | `main` | Vue 3 + Vite | `/var/www/gdice.cc` |
| ezspell.com | `git@bitbucket.org:Geo4orce/ezspell.git` | `main` | Svelte + Webpack | `/var/www/ezspell.com` |

### Deployment Model (symlink-swap)

All sites use a **symlink-swap release** system. No git, Node, or npm on the server.

```
/var/www/<site>/
├── releases/
│   ├── 0.8.0/
│   ├── 0.8.1/     ← each release is a self-contained directory
│   └── 0.9.0/
├── current -> releases/0.9.0   ← atomic symlink switch
└── shared/        ← web-opt.com only (.env, storage/)
```

- **Build locally** → **rsync** to `releases/<version>/` → **`deploy-switch <site> <version>`**
- Scripts: `/usr/local/bin/deploy-switch`, `/usr/local/bin/deploy-rollback`
- Source: `infra/bin/` in this repo (version-controlled)
- Nginx configs: `infra/nginx/` in this repo
- Fresh server setup: `infra/setup.md`
- Deploy script tests: `infra/tests/` (run on server as `deploy` user)
- Version check: `curl https://<site>/version.txt`
- Keeps last 5 releases, prunes older ones
- Rollback: `ssh geo@web-opt.com "sudo -u deploy deploy-rollback <site>"`

### Users & Permissions

| User | Purpose |
|------|---------|
| `geo` | Admin, sudoer. **Must use `sudo -u deploy`** for any write inside `/var/www/` (deploys, editing `.env`, creating dirs, etc.) |
| `deploy` | Owns `/var/www/`. Secondary group `www-data`. No sudo |
| `www-data` | Nginx worker. Reads all files, writes to Laravel storage/cache |

| Scope | Owner:Group | Mode |
|-------|------------|------|
| Static releases (gdice.cc, ezspell.com) | `deploy:deploy` | dirs `755`, files `644` |
| Laravel release files | `deploy:deploy` | dirs `755`, files `644` |
| `shared/storage/` | `deploy:www-data` | `2775` recursive |
| `shared/.env` | `deploy:www-data` | `640` |
| `bootstrap/cache/` (per-release) | `deploy:www-data` | `2775` recursive |

---

## Web-Opt.com — Project Details

- **Domain**: https://web-opt.com/
- **Tech Stack**: Laravel 8 + PHP 8.3-FPM + Laravel Mix (Webpack) + SCSS

### Deploy
Use `/deploy` workflow. Summary:
1. `npm test` → `npm run prod` → bump version → commit → push
2. `rsync` project to server (excl .git, node_modules, vendor, storage, .env)
3. `ssh deploy@web-opt.com "web-opt.com <version>"` (runs composer install, artisan caches, symlink switch)

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
- `vendor/` excluded from rsync — `composer install --no-dev` runs on server
- `shared/.env` and `shared/storage/` symlinked into each release by `deploy-switch`
- `bootstrap/cache/` is per-release (NOT shared)
