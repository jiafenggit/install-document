#服务器依赖处理
composer update --no-dev --optimize-autoloader

php app/console cache:clear  --env=prod --no-debug
php app/console assetic:dump --env=prod --no-debug
<pre>

$ rm -rf app/cache/*
$ rm -rf app/logs/*

</pre>



#设置ACL

<pre>

$ HTTPDUSER=`ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
$ sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs
$ sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX app/cache app/logs


或者
HTTPDUSER=`ps aux | grep -E '[n]ginx' | grep -v root | head -1 | cut -d\  -f1`


composer  update  --no-dev --no-scripts
</pre>



#nginx 配置symfony
* 使用虚拟主机的方式

    
server {
    listen       80;
    server_name  www.xieyaokun.com;
    root /www/lnmp/www/manage/web;

    location / {
        # try to serve file directly, fallback to app.php
        try_files $uri /app.php$is_args$args;
    }
    # DEV
    # This rule should only be placed on your development environment
    # In production, don't include this and don't deploy app_dev.php or config.php
    location ~ ^/(app_dev|config)\.php(/|$) {
        fastcgi_pass   127.0.0.1:9001;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;
    }
    # PROD
    location ~ ^/app\.php(/|$) {
        fastcgi_pass   127.0.0.1:9001;
        fastcgi_split_path_info ^(.+\.php)(/.*)$;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param HTTPS off;
        # Prevents URIs that include the front controller. This will 404:
        # http://domain.tld/app.php/some-path
        # Remove the internal directive to allow URIs like this
        internal;
    }

    error_log  /www/lnmp/logs/project_error.log;
    access_log /www/lnmp/logs/project_access.log;
}
    
    



