# Fresh Droplet Setup

Bootstrap a new Ubuntu server to host gdice.cc, ezspell.com, and web-opt.com.

## Prerequisites

- Ubuntu 24.04 LTS droplet
- Root SSH access
- DNS A records pointing all 3 domains (+ www variants) to the droplet IP

## 1. System basics

```bash
apt update && apt upgrade -y
apt install -y nginx certbot python3-certbot-nginx php8.3-fpm php8.3-mbstring php8.3-xml php8.3-curl php8.3-zip unzip
```

## 2. Install Composer

```bash
curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
```

## 3. Create users

```bash
# Admin user
adduser geo
usermod -aG sudo geo

# Deploy user (no sudo, secondary group www-data)
adduser --disabled-password --gecos "" deploy
usermod -aG www-data deploy
```

## 4. Directory structure

```bash
mkdir -p /var/www/{gdice.cc,ezspell.com,web-opt.com}/{releases}
mkdir -p /var/www/web-opt.com/shared/storage/{app/public,framework/{cache,sessions,views},logs}

chown -R deploy:deploy /var/www
chmod -R 755 /var/www

# Laravel writable dirs
chown -R deploy:www-data /var/www/web-opt.com/shared/storage
chmod -R 2775 /var/www/web-opt.com/shared/storage
```

## 5. Deploy scripts

```bash
cp infra/bin/deploy-switch /usr/local/bin/deploy-switch
cp infra/bin/deploy-rollback /usr/local/bin/deploy-rollback
chmod 755 /usr/local/bin/deploy-switch /usr/local/bin/deploy-rollback
chown root:root /usr/local/bin/deploy-switch /usr/local/bin/deploy-rollback
```

## 6. SSH key for deploy user

```bash
sudo -u deploy ssh-keygen -t ed25519 -f /home/deploy/.ssh/deploy_key -N ""
```

Add the public key to Bitbucket, then configure forced command:

```bash
# /home/deploy/.ssh/authorized_keys
command="/usr/local/bin/deploy-switch ${SSH_ORIGINAL_COMMAND}",no-port-forwarding,no-X11-forwarding,no-agent-forwarding <paste-public-key-here>
```

```bash
chown -R deploy:deploy /home/deploy/.ssh
chmod 700 /home/deploy/.ssh
chmod 600 /home/deploy/.ssh/authorized_keys
```

## 7. Nginx configs

```bash
cp infra/nginx/gdice.cc /etc/nginx/sites-available/gdice.cc
cp infra/nginx/ezspell.com /etc/nginx/sites-available/ezspell.com
cp infra/nginx/web-opt.com /etc/nginx/sites-available/web-opt.com

ln -sf /etc/nginx/sites-available/gdice.cc /etc/nginx/sites-enabled/
ln -sf /etc/nginx/sites-available/ezspell.com /etc/nginx/sites-enabled/
ln -sf /etc/nginx/sites-available/web-opt.com /etc/nginx/sites-enabled/
rm -f /etc/nginx/sites-enabled/default

nginx -t && systemctl reload nginx
```

## 8. SSL certificates

```bash
certbot --nginx -d gdice.cc -d www.gdice.cc
certbot --nginx -d ezspell.com -d www.ezspell.com
certbot --nginx -d web-opt.com -d www.web-opt.com
```

## 9. Laravel .env

Copy `.env` from your password manager to `/var/www/web-opt.com/shared/.env`:

```bash
chown deploy:www-data /var/www/web-opt.com/shared/.env
chmod 640 /var/www/web-opt.com/shared/.env
```

## 10. First deploy

From your local machine, run the deploy workflow for each site. This will rsync the first release and call `deploy-switch`.

## 11. Verify

```bash
curl -s -o /dev/null -w '%{http_code}' https://gdice.cc/
curl -s -o /dev/null -w '%{http_code}' https://ezspell.com/
curl -s -o /dev/null -w '%{http_code}' https://web-opt.com/
```
