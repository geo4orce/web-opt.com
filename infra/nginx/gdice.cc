# www → non-www redirect (HTTPS)
server {
    listen 443 ssl;
    server_name www.gdice.cc;

    ssl_certificate /etc/letsencrypt/live/gdice.cc/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/gdice.cc/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    return 301 https://gdice.cc$request_uri;
}

server {
    server_name gdice.cc;

    root /var/www/gdice/current;
    index index.html;

    location / {
        try_files $uri $uri/ /index.html;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    listen 443 ssl;
    ssl_certificate /etc/letsencrypt/live/gdice.cc/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/gdice.cc/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}

# HTTP → HTTPS redirect (all variants → non-www)
server {
    listen 80;
    server_name gdice.cc www.gdice.cc;
    return 301 https://gdice.cc$request_uri;
}
