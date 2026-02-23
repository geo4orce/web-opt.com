---
description: Deploy Web-Opt.com to production (commit, push, build on server)
---

1. Check for uncommitted changes. If there are any, stage all and commit with a descriptive message.

2. Push to Bitbucket: `git push origin master`

3. SSH to server and deploy:
```
ssh geo@web-opt.com "export NVM_DIR=~/.nvm && source ~/.nvm/nvm.sh && cd /var/www/web-opt.com && git pull origin master && composer install --no-dev --optimize-autoloader && php artisan config:cache && php artisan route:cache && php artisan view:cache && npm install && npm run prod"
```

4. Reload Nginx: `ssh geo@web-opt.com "sudo nginx -t && sudo systemctl reload nginx"`

5. Verify the site is up: `ssh geo@web-opt.com "curl -s -o /dev/null -w '%{http_code}' https://www.web-opt.com/"`
