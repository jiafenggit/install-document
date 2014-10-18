####nginx
<pre>
在nginx源码包目录下：
./configure \
    --prefix=/usr/local/lnmp/nginx/ \
    --sbin-path=/usr/local/lnmp/nginx/nginx \
    --conf-path=/usr/local/lnmp/nginx/nginx.conf \
    --pid-path=/usr/local/lnmp/nginx/nginx.pid \
    --with-http_ssl_module \
    --with-pcre=../pcre-8.36 \
    --with-zlib=../zlib-1.2.8 \

</pre>



####libxml2
<pre>
./configure --prefix=/usr/local/lnmp/libxml2/  --with-python=no
make
make install
</pre>


####libpng
<pre>
./configure --prefix=/usr/local/lnmp/libpng/
make
make install
</pre>

####jpeg9
<Pre>
./configure --prefix=/usr/local/lnmp/jpeg9/ --enable-shared  --enable-static
make
make install
</pre>

####freetype
<pre>
./configure --prefix=/usr/local/lnmp/freetype/
make
make install
</pre>

####libgd2
<pre>
./configure \
 --prefix=/usr/local/lnmp/gd2/ \
 --with-jpeg=/usr/local/lnmp/jpeg9/ \
 --with-freetype=/usr/local/lnmp/freetype/ \
 --with-png=/usr/local/lnmp/libpng/
make
make install
</pre>


####安装zlib

<pre>
./configure \
--prefix=/usr/local/lnmp/zlib \
 make
 make install 
</pre>

</pre>

 
####安装pcre
<pre>
 ./configure --prefix=/usr/local/lnmp/pcre/
 make 
 make install
</pre>

####openssl安装
(先设置参数设置为64位)
CFLAGS=-fPIC \
./config \
--prefix=/usr/local \
--openssldir=/usr/local/lnmp/openssl \
--shared \
 make
 make install

###源码安装PHP
<pre>
在php源码包目录下：

./configure \
--prefix=/usr/local/lnmp/php  \
--with-libxml-dir=/usr/local/lnmp/libxml2/ \
--with-jpeg-dir=/usr/local/lnmp/jpeg9/ \
--with-png-dir=/usr/local/lnmp/libpng/ \
--with-pcre-dir=/usr/local/lnmp/pcre/ \
--with-freetype-dir=/usr/local/lnmp/freetype/ \
--with-gd=/usr/local/lnmp/gd2/ \
--with-openssl-dir=/usr/local/lnmp/openssl \
--with-zlib=/usr/local/lnmp/zlib \
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