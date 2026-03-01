# Web-Opt.com

Company website — [web-opt.com](https://web-opt.com/)

Laravel 8 + PHP 8.3 + Laravel Mix + SCSS

## Local Dev
```bash
composer install
npm install
php artisan serve
npm run watch
```

## Infrastructure

See [`AGENTS.md`](AGENTS.md) for full server/deploy details. Key files:

- `infra/bin/` — deploy-switch & deploy-rollback scripts
- `infra/nginx/` — Nginx site configs
- `infra/setup.md` — fresh server setup guide
- `infra/tests/` — deploy script smoke tests

## Contact

[geo@web-opt.com](mailto:geo@web-opt.com)
