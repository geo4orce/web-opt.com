---
description: Deploy Web-Opt.com to production (commit, push, build on server)
---

Full pipeline with fail-fast — abort and report on any failure.

// turbo
1. Tests: `npm test`

// turbo
2. Build: `npm run prod`

3. If there are uncommitted changes, stage all and commit with a descriptive message. If clean, skip to step 4.

4. Push: `git push origin main`

5. SSH deploy: `ssh geo@web-opt.com "export NVM_DIR=~/.nvm && source ~/.nvm/nvm.sh && cd /var/www/web-opt.com && git pull origin main && composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache && npm install && npm run prod"`

6. Reload Nginx: `ssh geo@web-opt.com "sudo nginx -t && sudo systemctl reload nginx"`

// turbo
7. Verify: `ssh geo@web-opt.com "curl -s -o /dev/null -w '%{http_code}' https://web-opt.com/"`
