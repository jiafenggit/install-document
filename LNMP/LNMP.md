#<center>LNMP</center>
##ubuntu 软件源apt-get安装LNMP
<Pre>
sudo apt-get install nginx 
sudo apt-get install php5 php5-cli php5-fpm php5-gd  php5-imagick php5-imap php5-json php5-mcrypt php5-memcache php5-mhash php5-ming php5-mysql php5-ps php5-pspell php5-recode php5-snmp php5-sqlite  php5-tidy php5-xcache php5-xmlrpc php5-xsl php-pear php-soap
</Pre>

##源码包安装LNMP
###NGINX 源码安装(测试环境ubuntu，需要root(sudo 命令)的权限执行一下代码 )
####说明和注意事项：
*  --with-pcre=pcre源码包所在的路径
*  --with-zlib=zlib源码包在的路径
*  --\ linux代码换行符，不当做代码执行
####安装代码
```
在nginx源码包目录下：
./configure \
    --sbin-path=/usr/local/nginx/nginx \
    --conf-path=/usr/local/nginx/nginx.conf \
    --pid-path=/usr/local/nginx/nginx.pid \
    --with-http_ssl_module \
    --with-pcre=../pcre-8.34 \
    --with-zlib=../zlib-1.2.8 \
```
###编译php所需(安装目录都是在当前软件包目录下)
apt-get install autoconf limXpm-dev
####libxml2
<pre>
./configure --prefix=/usr/local/libxml2/
make
make install
</pre>

####libmcrypt
<pre>
./configure --prefix=/usr/local/libmcrypt/
make
make install

cd libltdl

./configure --enable-ltdl-install
make
make install
</pre>
```
####libpng

./configure --prefix=/usr/local/libpng/
make
make install


####jpeg9

./configure --prefix=/usr/local/jpeg9/ --enable-shared  --enable-static
make
make install



####freetype

./configure --prefix=/usr/local/freetype/
make
make install


####autoconf

./configure
make
make install


####libgd2

./configure \
 --prefix=/usr/local/gd2/ \
 --with-jpeg=/usr/local/jpeg9/ \
 --with-freetype=/usr/local/freetype/ \
 --with-png=/usr/local/libpng/
make
make install


```
###源码安装PHP
```
在php源码包目录下：

./configure \
       --prefix=/usr/local/php  \
       --with-mcrypt=/usr/local/libmcrypt  \
       --with-libxml-dir=/usr/local/libxml2/ \
       --with-jpeg-dir=/usr/local/jpeg9/ \
       --with-png-dir=/usr/local/libpng/ \
       --with-pcre-dir=/usr/local/pcre/ \
       --with-freetype-dir=/usr/local/freetype/ \
       --with-gd=/usr/local/gd2/ \
       --with-xpm-dir=/usr/lib/x86_64-linux-gnu/ \
       --with-openssl=/usr/local/openssl \
       --enable-soap \
       --enable-mbstring=all \
       --enable-sockets \
       --enable-pdo \
       --enable-zip \
       --enable-fpm \
       --enable-xml \
       --enable-bcmath \
       --enable-shmop \
       --enable-sysvsem \
       --enable-pcntl \
       --with-curl=/usr/local/curl/\
       --with-zlib=/usr/local/zlib\
       
       
           
```

###PHP添加扩展
```
usr/local/php/bin/phpize

./configure \
    --enable-redis \
    --with-php-config=/usr/local/php/bin/php-config
 
make
make install
```


###修改配置
```
####nginx配置
vi nginx.conf

设置网站根目录
 location / {
            root   /home/www;
            index  index.html index.php  index.htm;
             }
        
  设置解析php       
        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
   
        location ~ \.php$ {
           root          /home/www;
           fastcgi_pass   127.0.0.1:9000;
           fastcgi_index  index.php;
           fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
           include        fastcgi_params;
        }

```
####php配置
```
php源码包中复制php.ini-development或者 php.ini-production  到 /php/etc/php.ini

php安装目录下复制 cp php-fpm.conf.default  php-fpm.conf
vi php-fpm.conf


设置用户
groupadd mysql
useradd mysql -g mysql -M -s /sbin/nologin

增加一个名为 mysql的用户。
-g：指定新用户所属的用户组(group)
-M：不建立根目录
-s：定义其使用的shell，/sbin/nologin代表用户不能登录系统。
sudo useradd nginx
user = nginx
group = nginx
```

解决php依赖
php composer.phar 


####配置加速器
apc
 --with-php-config=/usr/local/php/bin/php-config --enable-apcu
 
 
##设置nginx pathinfo模式
<pre>
 打开Nginx的配置文件nginx.conf
在server中加入一下配置：

location ~ .php {  //去除#
root d:/ThinkPHP/;
fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
fastcgi_pass 127.0.0.1:9000;
fastcgi_index index.php;
include fastcgi_params; 
#pathinfo support 
set $real_script_name $fastcgi_script_name;
set $path_info ””;
if ( $fastcgi_script_name ~ “^(.+?.php)(/.+)$”){
set $real_script_name $1;
set $path_info $2;
} fastcgi_param SCRIPT_NAME $real_script_name;
fastcgi_param PATH_INFO $path_info; 
}

需要注意的是那个if判断语句，在(的前后都必须有空格，否则Nginx会报配置语法错误。
</pre>