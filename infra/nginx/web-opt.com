# www → non-www redirect (HTTPS)
server {
    listen 443 ssl;
    server_name www.web-opt.com;

    ssl_certificate /etc/letsencrypt/live/web-opt.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/web-opt.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;

    return 301 https://web-opt.com$request_uri;
}

server {
    server_name web-opt.com;

    root /var/www/web-opt.com/current/public;
    index index.php index.html;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/run/php/php8.3-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }

    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg|woff|woff2|ttf|eot)$ {
        expires 30d;
        add_header Cache-Control "public, no-transform";
    }

    listen 443 ssl;
    ssl_certificate /etc/letsencrypt/live/web-opt.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/web-opt.com/privkey.pem;
    include /etc/letsencrypt/options-ssl-nginx.conf;
    ssl_dhparam /etc/letsencrypt/ssl-dhparams.pem;
}

# HTTP → HTTPS redirect (all variants → non-www)
server {
    listen 80;
    server_name web-opt.com www.web-opt.com;
    return 301 https://web-opt.com$request_uri;
}
