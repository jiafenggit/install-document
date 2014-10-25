<pre>
libxml2

./configure --prefix=/usr/local/lamp/libxml2/  --with-python=no

libpng
./configure --prefix=/usr/local/lamp/libpng/

jpeg9
./configure --prefix=/usr/local/lamp/jpeg9/ --enable-shared  --enable-static

freetype
./configure --prefix=/usr/local/lamp/freetype/

libgd2
./configure \
 --prefix=/usr/local/lamp/gd2/ \
 --with-jpeg=/usr/local/lamp/jpeg9/ \
 --with-freetype=/usr/local/lamp/freetype/ \
 --with-png=/usr/local/lamp/libpng/ \

zlib
./configure \
--prefix=/usr/local/lamp/zlib \

pcre
./configure --prefix=/usr/local/lamp/pcre/

openssl
 CFLAGS=-fPIC \
 ./config \
 --prefix=/usr/local \
 --openssldir=/usr/local/lamp/openssl \
 --shared \ 

apr-1.5
cp -r apr-1.5.1 httpd-2.4.10/srclib/apr

apr-util-1.5.4
cp -r apr-util-1.5.4 httpd-2.4.10/srclib/apr-util

apache 
./configure \
--prefix=/usr/local/lamp/apache2/ \
--sysconfdir=/usr/local/lamp/apache2/etc/ \
--enable-mods-shared=all \
--enable-deflate \
--enable-speling \
--enable-cache \
--enable-file-cache \
--enable-disk-cache \
--enable-mem-cache \
--enable-so \
--enable-expires \
--enable-rewrite\
--enable-ssl \
--with-ssl=/usr/local/lamp/openssl/ \
--with-included-apr \
--with-pcre=/usr/local/lamp/pcre \

/*如果复制到了apache目录可以不需要这个参数*/
--with-apr=/usr/local/apr/ \
--with-apr-util=/usr/local/apr-util/ \



maridb
cmake ./ \
-DCMAKE_INSTALL_PREFIX=/usr/local/lamp/maridb \
-DMYSQL_DATADIR=/www/maridb \
-DSYSCONFDIR=/usr/local/lamp/maridb/etc \
-DWITH_MYISAM_STORAGE_ENGINE=1 \
-DWITH_INNOBASE_STORAGE_ENGINE=1 \
-DWITH_MEMORY_STORAGE_ENGINE=1 \
-DWITH_XTRADB_STORAGE_ENGINE=1 \
-DWITH_FEDERATED_STORAGE_ENGINE=1 \
-DWITH_PARTITION_STORAGE_ENGINE=1  \
-DWITH_BLACKHOLE_STORAGE_ENGINE=1 \
-DWITH_READLINE=1 \
-DMYSQL_UNIX_ADDR=/tmp/mysqld.sock \
-DMYSQL_TCP_PORT=3307  \
-DENABLED_LOCAL_INFILE=1 \
-DEXTRA_CHARSETS=all  \
-DDEFAULT_CHARSET=utf8 \
-DDEFAULT_COLLATION=utf8_general_ci \
-DWITH_BIG_TABLES=1 \
-DWITH_DEBUG=0 \

php
./configure \
--prefix=/usr/local/lamp/php  \
--with-config-file-path=/usr/local/lamp/php/etc/ \
--with-apxs2=/usr/local/lamp/apache2/bin/apxs \
--with-libxml-dir=/usr/local/lamp/libxml2/ \
--with-jpeg-dir=/usr/local/lamp/jpeg9/ \
--with-png-dir=/usr/local/lamp/libpng/ \
--with-pcre-dir=/usr/local/lamp/pcre/ \
--with-freetype-dir=/usr/local/lamp/freetype/ \
--with-gd=/usr/local/lamp/gd2/ \
--with-openssl-dir=/usr/local/lamp/openssl \
--with-zlib=/usr/local/lamp/zlib \
--with-mysql=/usr/local/lamp/maridb \
--enable-soap \
--enable-mbstring=all \
--enable-sockets \
--enable-pdo \
--enable-zip \
--enable-fpm \
--enable-xml \
--enable-bcmath \
--enable-pcntl \
--with-curl \
--with-openssl \
--with-pdo-mysql  \
--with-zlib \
--with-openssl \
--with-bz2 \
--with-mcrypt \
--with-mysqli \
--enable-exif \
--enable-intl \
--enable-ftp \
--enable-calendar \
--enable-sysvshm \
--enable-sysvsem  \
--enable-sysvmsg  \
--enable-shmop \
--enable-mysqlnd \


</pre>

