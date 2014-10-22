##php配置选项
<pre>
/configure --prefix=/usr/local/php 
--with-config-file-path=/usr/local/php/etc 
--with-mysql=/usr/local/mysql
 --with-mysqli=/usr/bin/mysql_config -
 -with-iconv-dir=/usr/local
  --with-freetype-dir
  --with-jpeg-dir --with-png-dir 
  --with-zlib --with-libxml-dir=/usr 
  --enable-xml --disable-rpath 
  --enable-discard-path
   --enable-safe-mode 
   --enable-bcmath 
 --enable-shmop
  --enable-sysvsem
   --enable-inline-optimization
    --with-curl -
    -with-curlwrappers
--enable-mbregex 
--enable-fastcgi 
--enable-fpm
 --enable-force-cgi-redirect
  --enable-mbstring 
  --with-mcrypt 
  --with-gd 
  --enable-gd-native-ttf
   --with-openssl 
   --with-mhash
    --enable-pcntl 
    --enable-sockets 
    --with-ldap 
    --with-ldap-sasl 
    --with-xmlrpc
     --enable-zip 
    --enable-soap 
    --without-pear 
    --with-zlib 
    --enable-pdo 
    --with-pdo-mysql --with-mysql 
#mysqli扩展技术不仅可以调用MySQL的存储过程、处理MySQL事务，而且还可以使访问数据库工作变得更加稳定。 
make ZEND_EXTRA_LIBS='-liconv' 
make install  
</pre>



php.ini 设置expose =off可以隐藏php版本号