# www → non-www redirect (HTTPS)
server {
    listen 443 ssl;
    server_name www.ezspell.com;

    ssl_certificate /etc/letsencrypt/live/ezspell.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/ezspell.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    return 301 https://ezspell.com$request_uri;
}

server {
    server_name ezspell.com;

    root /var/www/ezspell.com/current;
    index index.html;

    location / {
        try_files $uri $uri/ /index.html;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    listen 443 ssl;
    ssl_certificate /etc/letsencrypt/live/ezspell.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/ezspell.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}

# HTTP → HTTPS redirect (all variants → non-www)
server {
    listen 80;
    server_name ezspell.com www.ezspell.com;
    return 301 https://ezspell.com$request_uri;
}
