#centos 7 搭建LAMP环境
###遵循的要求
* 安装遵循需要什么安装什么 
* 安装时选择最小化安装
* 设置英语 时区选择shanghai
* 硬盘分区并且启用lvm(逻辑卷管理,目的是为了可以动态的添加磁盘空间，划分空间)


##系统安装完成，下面是一些必要的配置
###第一步设置ip地址
<Pre>
设置ip
root 用户下
vi /etc/network-scripts/ifcfg-ens33
修改设置：
BOOTPROTO=STATIC
ONBOOT=YES
添加选项
IPADDR=192.168.0.133 (您的的ip)
NETMASK=255.255.255.0 (子网掩码)
GATEWAY=192.168.0.1 （网关）
DNS1 = 233.5.5.5    （dns）
</pre>


###重启网络服务
<Pre>
service network restart 或者 systemctl restart network
查看 ip命令:  ip addr
</pre>

##开始搭建LAMP
###换源：（测试用而已,可以省略）
cd /etc/yum.repos.d
备份当前目录下的CentOS-Base.repo
cp CentOS-Base.repo.backup
vi CentOS-Base.repo  
修改里面的 mirrorlist.centos.org 换为制定的源比如http://mirrors.yun-idc.com/  
或者下载源文件文件，前提必选先安装weget，最小化情况下wget未安装
wget -O CentOS-Base.repo http://mirrors.aliyuncs.com/repo/Centos-7.repo

###更新系统
yum install -y update
###停止不需要的服务
<Pre>

</pre>
###准备需要的包
<pre>

yum -y install \
gcc \
gcc-c++ \
python \
python-devel \
cmake \
perl \
libtool* \
libtool-ltdl* \
libXpm-devel   \
libXext-devel \
libevent \
autoconf \
openssl \
openssl-devel \
bzip2-devel \
libcurl-devel \
libicu-devel \
bison ncurses* \

</pre>
###安装依赖包
<pre>
软件包下载地址

libxml2下载地址：ftp://xmlsoft.org/libxml2/libxml2-2.9.1.tar.gz

尽量使用2.5.7版本，高版本可能出现问题
libmcrypt下载地址：http://jaist.dl.sourceforge.net/project/mcrypt/Libmcrypt/2.5.8/libmcrypt-2.5.8.tar.gz

zlib下载地址：http://zlib.net/zlib-1.2.8.tar.gz

libpng下载地址http://jaist.dl.sourceforge.net/project/libpng/libpng16/1.6.13/libpng-1.6.13.tar.gz

freetype下载地址：http://ftp.yzu.edu.tw/nongnu//freetype/freetype-2.5.3.tar.gz

pcre下载地址ftp://ftp.csx.cam.ac.uk/pub/software/programming/pcre/pcre-8.36.tar.gz

jpeg9下载地址：http://www.ijg.org/files/jpegsrc.v9a.tar.gz

libgd2下载地址：
https://bitbucket.org/libgd/gd-libgd/downloads（由于是亚马逊云地址，每次都是改变的因此这个下载列表）需要时选择下载

apache2.4下载地址：http://mirror.bit.edu.cn/apache//httpd/httpd-2.4.10.tar.gz

apache依赖包apr下载地址http://mirrors.cnnic.cn/apache//apr/apr-1.5.1.tar.gz

apache依赖包apr-util下载地址http://mirrors.cnnic.cn/apache//apr/apr-util-1.5.4.tar.gz

apache依赖包apr-iconv下载地址：http://mirrors.cnnic.cn/apache//apr/apr-iconv-1.2.1.tar.gz

php5.61安装包下载地址:http://cn2.php.net/get/php-5.6.1.tar.gz/from/a/mirror

php加速器扩展apc下载地址:http://pecl.php.net/get/APC-3.1.9.tgz

memcache扩展下载地址：http://pecl.php.net/get/memcache-2.2.7.tgz

redis扩展http://pecl.php.net/get/redis-2.2.5.tgz

pdo-mysql扩展http://pecl.php.net/get/PDO_MYSQL-1.0.2.tgz

intl扩展：http://pecl.php.net/get/intl-3.0.0.tgz

openssl下载地址：http://www.openssl.org/source/openssl-1.0.1i.tar.gz

apcu下载地址：http://pecl.php.net/get/apcu-4.0.6.tgz

memcached下载地址：http://memcached.org/files/memcached-1.4.20.tar.gz

memcache php扩展下载地址：http://pecl.php.net/get/memcache-2.2.7.tgz

redis php扩展下载地址：http://pecl.php.net/get/redis-2.2.5.tgz

</pre>

###解压包命令: tar -zxvf 包名

<pre>
安装Libxml2
./configure --prefix=/usr/local/libxml2/
 make 
 make install 


安装libmcrypt
./configure --prefix=/usr/local/libmcrypt/ 
 make 
 make install
 
进入libmcrypt目录下的 libltdl目录
  ./configure --enable-ltdl-install
 make
 make install


 
 安装zlib
　./configure
 make
 make install 
 
 安装 libpng
 ./configure --prefix=/usr/local/libpng/
 make
 make install
 
  安装freetype
 ./configure --prefix=/usr/local/freetype/
 make
 make install 

 
 安装pcre
 ./configure --prefix=/usr/local/pcre/
 make 
 make install
 
 安装jpeg9 
 ./configure --prefix=/usr/local/jpeg9/ \
 --enable-shared \
 --enable-static \
 make
 make install 
 
 安装gd库
./configure \
 --prefix=/usr/local/gd2/ \
 --with-jpeg=/usr/local/jpeg9/ \
 --with-freetype=/usr/local/freetype/ \
 --with-png=/usr/local/libpng \

 apr安装
 ./configure --prefix=/usr/local/apr
 make 
 make install
 apr-util安装
 ./configure --prefix=/usr/local/apr-util --with-apr=/usr/local/apr/
 make
 make install

openssl安装
(先设置参数设置为64位)
CFLAGS=-fPIC \
./config \
--prefix=/usr/local \
--openssldir=/usr/local/openssl \
--shared \
 make
 make install


apache
将APR和APR-util源码下载，解压放到httpd-2.4.3/srclib里面，并去除版本号
cp -r apr-1.5.1 httpd-2.4.9/srclib/apr
cp -r apr-util-1.5.3 httpd-2.4.9/srclib/apr-util

安装apache
cd cd httpd-2.4.10
./configure \
--prefix=/usr/local/apache2/ \
--sysconfdir=/usr/local/apache2/etc/ \
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
--with-ssl=/usr/local/openssl/ \
--with-apr=/usr/local/apr/ \
--with-apr-util=/usr/local/apr-util/ \
--with-included-apr \
--with-pcre=/usr/local/pcre \
make 
make install



</pre>
<pre>
apache参数解释
./configure //配置源代码树
--prefix=/usr/local/apache2 //体系无关文件的顶级安装目录PREFIX ，也就Apache的安装目录。
--enable-module=so //打开 so 模块，so 模块是用来提 DSO 支持的 apache 核心模块
--enable-deflate //支持网页压缩
--enable-expires//支持 HTTP 控制
--enable-rewrite //支持 URL 重写
--enable-cache   //支持缓存
--enable-file-cache   //支持文件缓存
--enable-mem-cache   //支持记忆缓存
--enable-disk-cache   //支持磁盘缓存
--enable-static-support //支持静态连接(默认为动态连接)
--enable-static-htpasswd //使用静态连接编译 htpasswd - 管理用于基本认证的用户文件
--enable-static-htdigest //使用静态连接编译 htdigest - 管理用于摘要认证的用户文件 
--enable-static-rotatelogs //使用静态连接编译 rotatelogs - 滚动 Apache 日志的管道日志程序 
--enable-static-logresolve //使用静态连接编译 logresolve - 解析 Apache 日志中的IP地址为主机名
--enable-static-htdbm //使用静态连接编译 htdbm - 操作 DBM 密码数据库 
--enable-static-ab //使用静态连接编译 ab - Apache HTTP 服务器性能测试工具
--enable-static-checkgid //使用静态连接编译 checkgid 
--disable-cgid //禁止用一个外部 CGI 守护进程执行CGI脚本
--disable-cgi //禁止编译 CGI 版本的 PHP
--disable-userdir //禁止用户从自己的主目录中提供页面
--with-mpm=worker // 让apache以worker方式运行
--enable-authn-dbm=shared // 对动态数据库进行操作。Rewrite时需要。

/usr/local/apache/bin/apachectl -M   =-t -D DUMP_MODULES 安装了哪些模块
/usr/local/apache/bin/apachectl -t    测试安装是否成功
/usr/local/apache/bin/apachectl -k start|restart|stop 查看详细
</pre>

<pre>　
安装成功修改 vi/etc/local/apache2/etc/httpd.conf; 
设置主机名字 servername localhost:80

测试apache是否安装成功
/usr/local/apache2/bin/apachectl start

/sbin/iptables -I INPUT -p tcp --dport 80 -j ACCEPT 
启用80端口


不可访问设置设置selinux
vi /etc/sysconfig/selinux
设置
sexlinux=disabled

安装网络查看工具
yum install net-tool


在httpd.conf里
查找“AddType text/html”，
然后在这行代码后面，加上一行即可：
添加解析类型:Addtype application/x-httpd-php .php .phtml .phps 


设置开机启动
echo "/usr/local/apache2/bin/apachectl start" >> /etc/rc.d/rc.local



按天生成日志的方法：
http://blog.163.com/sujoe_2006/blog/static/3353151201121285820104/
</pre>
<pre>
安装mysql

groupadd mysql
useradd mysql -g mysql -M -s /sbin/nologin

增加一个名为 mysql的用户。
-g：指定新用户所属的用户组(group)
-M：不建立根目录
-s：定义其使用的shell，/sbin/nologin代表用户不能登录系统。

安装mysql
cmake ./ \
-DCMAKE_INSTALL_PREFIX=/usr/local/mysql \
-DMYSQL_DATADIR=/usr/local/mysql/data  \
-DSYSCONFDIR=/etc \
-DWITH_MYISAM_STORAGE_ENGINE=1 \
-DWITH_INNOBASE_STORAGE_ENGINE=1 \
-DWITH_MEMORY_STORAGE_ENGINE=1 \
-DWITH_FEDERATED_STORAGE_ENGINE=1 \
-DWITH_PARTITION_STORAGE_ENGINE=1  \
-DWITH_READLINE=1 \
-DMYSQL_UNIX_ADDR=/tmp/mysqld.sock \
-DMYSQL_TCP_PORT=3306  \
-DENABLED_LOCAL_INFILE=1 \
-DEXTRA_CHARSETS=all  \
-DDEFAULT_CHARSET=utf8 \
-DDEFAULT_COLLATION=utf8_general_ci \
make
make install

# cd /usr/local/mysql 
# chown -R mysql:mysql .    (#这里最后是有个.的大家要注意# 为了安全安装完成后请修改权限给root用户)
# scripts/mysql_install_db --user=mysql    (先进行这一步再做如下权限的修改)
# chown -R root:mysql .     (将权限设置给root用户，并设置给mysql组， 取消其他用户的读写执行权限，仅留给mysql "rx"读执行权限，其他用户无任何权限)
# chown -R mysql:mysql ./data    (数据库存放目录设置成mysql用户mysql组)
# chmod -R ug+rwx  .     (赋予读写执行权限，其他用户权限一律删除仅给mysql用户权限)
 

参考设置网址：http://blog.sina.com.cn/s/blog_6d39ac7e0101cq48.html

复制配置文件：mysql的配置文件拷贝到/etc
# cp support-files/my-default.cnf  /etc/my.cnf


修改my.cnf配置
   # vi /etc/my.cnf
    
#[mysqld] 下面添加：
 user=mysql
   datadir=/usr/local/mysql/data/
   default-storage-engine=MyISAM
   explicit_defaults_for_timestamp=true

# bin/mysqld_safe --user=mysql &        或者直接进入bin文件夹下面
# cd bin
#./mysqld                              \ 这里说明，mysqld_safe或者mysqld都可以启动的


将mysql的启动服务添加到系统服务中 

# cp support-files/mysql.server  /etc/init.d/mysql 
现在可以使用下面的命令启动mysql 
# service mysql start 
停止mysql服务 
# service mysql stop 
重启mysql服务 
# service mysql restart 

chkconfig --add mysql
修改默认root账户密码，默认密码为空
修改密码 cd 切换到mysql所在目录
# cd /usr/local/mysql
# ./bin/mysqladmin -u root password

/etc/init.d/mysql start 或者 service mysql start

参考安装方法：

选项解释
# -DCMAKE_INSTALL_PREFIX=/usr/local/mysql          \    #安装路径
# -DMYSQL_DATADIR=/usr/local/mysql/data            \    #数据文件存放位置
# -DSYSCONFDIR=/etc                                \    #my.cnf路径
# -DWITH_MYISAM_STORAGE_ENGINE=1                   \    #支持MyIASM引擎
# -DWITH_INNOBASE_STORAGE_ENGINE=1                 \    #支持InnoDB引擎
# -DWITH_MEMORY_STORAGE_ENGINE=1                   \    #支持Memory引擎
# -DWITH_READLINE=1                                \    #快捷键功能(我没用过)
# -DMYSQL_UNIX_ADDR=/tmp/mysqld.sock               \    #连接数据库socket路径
# -DMYSQL_TCP_PORT=3306                            \    #端口
# -DENABLED_LOCAL_INFILE=1                         \    #允许从本地导入数据
# -DWITH_PARTITION_STORAGE_ENGINE=1                \    #安装支持数据库分区
# -DEXTRA_CHARSETS=all                             \    #安装所有的字符集
# -DDEFAULT_CHARSET=utf8                           \    #默认字符
# -DDEFAULT_COLLATION=utf8_general_ci


</pre>
<pre>
安装PHP
php 
./configure \
 --prefix=/usr/local/php/ \
 --with-config-file-path=/usr/local/php/etc/ \
 --with-apxs2=/usr/local/apache2/bin/apxs \
 --with-libxml-dir=/usr/local/libxml2/ \
 --with-jpeg-dir=/usr/local/jpeg9/ \
 --with-png-dir=/usr/local/libpng/ \
 --with-pcre-dir=/usr/local/pcre/ \
 --with-freetype-dir=/usr/local/freetype/ \
--with-mcrypt \
--with-mcrypt-dir=/usr/local/libmcrypt/ \
--with-xpm-dir=/usr/lib/ \
--with-mysql=/usr/local/mysql/ \
--with-zlib-dir=/usr/local/zlib/ \
--with-zlib \
--with-bz2 \
--with-openssl \
--with-pdo-mysql  \
--with-curl \
--with-mcrypt \
--enable-sockets \
--enable-soap \
--enable-mbstring \
--enable-bcmath \
--enable-intl \
--enable-ftp \
--enable-zip \
--enable-soap \
--enable-calendar \
--enable-sysvshm \
--enable-sysvsem  \
--enable-sysvmsg  \
--enable-shmop \
--enable-mysqlnd \

cp php.ini-production /usr/local/php/etc/php.ini


vi /usrl/local/php/etc/php.ini 
timezone=PRC


ln -s /usr/local/php/bin/php /usr/bin/php

遇到问题：yum  install  libmcrypt  libmcrypt-devel
wget http://elders.princeton.edu/data/puias/unsupported/6/x86_64/libmcrypt-2.5.8-9.puias6.x86_64.rpm
wget http://elders.princeton.edu/data/puias/unsupported/6/x86_64/libmcrypt-devel-2.5.8-9.puias6.x86_64.rpm
rpm -ivh libmcrypt-2.5.8-9.puias6.x86_64.rpm
rpm -ivh libmcrypt-devel-2.5.8-9.puias6.x86_64.rpm



libmemcached
https://launchpadlibrarian.net/165454254/libmemcached-1.0.18.tar.gz
./configure --prefix=/usr/local/libmemcached
make
make install


安装git
yum install git

安装composer

php -r "readfile('https://getcomposer.org/installer');" | php

设置composer
ln -s /usr/bin/composer.phar /usr/bin/composer


安装扩展php
memcache
/usr/local/php/bin/phpize
./comfigure --with-php-config=/usr/local/php/bin/php-config
make
make install

php.ini添加
memcache.so


重启apache
/usr/local/apache2/bin/apachectl restart

启动mysql 
/etc/init.d/mysql

查看开放的端口
netstat -tln

同步服务器时间
ntpdate -u 210.72.145.44 


tomcat官方安装文档
http://tomcat.apache.org/tomcat-8.0-doc/building.html#Download_a_Java_Development_Kit_(JDK)_version_7



安装jdk
yum  -y list java*
yum -y install  java-1.6.0-openjdk*
查看版本： java -version
有值说明安装成功
安装tomcat

复制 cp -R  apache-tomcat-8.0.14-src /usr/local/tomcat

cd /usr/local/tomcat
启动Tomcat

/usr/local/tomcat/bin/startup.sh   //启动tomcat
参考配置：http://blog.sina.com.cn/s/blog_6a7cdcd40101b1km.html

创建日志文件目录和文件
mkdir /usr/local/tomcat/logs/
touch /usr/local/tomcat/logs/catalina.out

加入开机启动 
在/etc/rc.d/rc.local中添加
/usr/local/tomcat/bin/startup.sh

防火墙开放8080端口
/sbin/iptables -I INPUT -p tcp --dport 8080 -j ACCEPT #开启8080端口 
/etc/rc.d/init.d/iptables save #保存配置  
或者service iptables save
/etc/rc.d/init.d/iptables restart #重启防火墙 

查看防火墙规则
 service iptables status



tomcat安全设置 参考 
http://blog.c1gstudio.com/archives/865

1.关闭服务器端口：
server.xml默认有下面一行：

<Server port="8005" shutdown="SHUTDOWN">
这样允许任何人只要telnet到服务器的8005端口，输入”SHUTDOWN”，然后回车，服务器立即就被关掉了。
从安全的角度上考虑，我们需要把这个shutdown指令改成一个别人不容易猜测的字符串，可以同时把端口也改了。
例如修改如下：

<Server port="8005" shutdown="c1gstudio">
这样就只有在telnet到8005，并且输入”c1gstudio”才能够关闭Tomcat.
注意：这个修改不影响shutdown.bat的执行。运行shutdown.bat一样可以关闭服务器。

2.增加防火墙
更安全的方式是同时增加防火墙，来限制访问Tomcat的控制与连接器端口
你可以通过运行netstat -a来查看网络服务器socket及其他现有连接的清单
插入规则
iptables -A INPUT -p tcp -m tcp --dport 8005 -j DROP
保存规则
service iptables save
重载规则
service iptables restart

3.处理好Tomcat管理台的安全
Tomcat管理台的应用文件，默认在{Tomcat安装目录}\server\webapps下，有admin和manager两个应用。
其用户密码，在{Tomcat安装目录}\conf/tomcat-users.xml中定义。在{Tomcat安装目录}\webapps下
admin.xml和manager.xml文件定义了可以通过访问/admin和/manager进入。
默认情况下，完全可以登录tomcat管理台，造成严重安全问题
检测办法：用IE打开链接http://[IP]:[Port]/admin，以用户名admin，密码为空登录，如果成功，
说明存在问题。
解决办法：可以删除{Tomcat安装目录}\webapps下admin.xml和manager.xml文件，或者去掉用户密
码，也可以删除应用文件。

4.运行错误网页

如果找不到网页即出现404错误，会显示服务器版本号，服务器配置也一目了然，
为了避免这种情况，希望自定义设置错误页面。
设置如下：
用记事本打开\conf\web.xml文件，在文件的倒数第二行（一行之前）加入以下内容：

<error-page>
    <error-code>404</error-code>
    <location>/404.jsp</location>
  </error-page>
  <error-page>
    <error-code>500</error-code>
    <location>/500.jsp</location>
  </error-page>
在根目录下创建404.jsp和500.jsp文件

5.多重服务器的安全防护模式
当在同一台主机（或同一网络文件系统）上的 Apache httpd Web 服务器与 Tomcat 之间共享网页的实际目录时，
请留意其个别安全防护模式间的相互作用。当你有“受保护的目录”时，这会特别重要。
服务器将具有能读取彼此文件的权限。
在这些状况下，请注意 Tomcat 并不会保护如 .htaccess 的文件，而Apache也不会保护Web应用程序的 WEB-INF 或 META-INF 目录。
这些情形都有可能导致重大的安全漏洞，所以，我们建议你在使用这些特别的目录时，要格外小心。

若要让 Apache httpd 保护 WEB-INF 及 META-INF 目录，请在 httpd.conf 中加入下列内容

<LocationMatch "/WEB-INF/">
AllowOverride None
deny from all
</LocationMatch>
<LocationMatch "/META-INF/">
AllowOverride None
deny from all
</LocationMatch>
6.屏蔽目录文件自动列出的方法
conf/web.xml文件

<servlet>
        <servlet-name>default</servlet-name>
        <servlet-class>org.apache.catalina.servlets.DefaultServlet</servlet-class>
        <init-param>
            <param-name>debug</param-name>
            <param-value>0</param-value>
        </init-param>
        <init-param>
            <param-name>listings</param-name>
            <param-value>false</param-value>
        </init-param>
        <load-on-startup>1</load-on-startup>
    </servlet>
 
<param-value>false</param-value>
这里false为不列出，true为充许列出

7.以非root用户运行

8.关闭8009端口
8009/tcp open ajp13

8009端口是tomcat和apache的mod_proxy_ajp,mod_jk沟通的端口，没有用到就关了。

tomcatpath/conf/server.xml 中的这段注释掉

<!--
    <Connector port="8009" protocol="AJP/1.3" redirectPort="8443" />
    -->
Related Posts

8005      远程停服务端口
8080      为HTTP端口，
8443      为HTTPS端口
8009     为AJP端口  APACHE能过AJP协议访问TOMCAT的8009端口。


NGINX 
ubuntu  ngINX php
sudo ./configure  \
 --prefix=/usr/local/php/  \
 --with-libxml-dir=/usr/include/libxml2/ \
 --with-jpeg-dir=/usr/local/jpeg9/ \
 --with-png-dir=/usr/local/libpng/ \
 --with-pcre-dir=/usr/local/pcre/ \
 --with-freetype-dir=/usr/local/freetype/ \
 --with-gd=/usr/local/gd2/  \
 --with-mcrypt=/usr/local/libmcrypt/  \ 
 --with-xpm-dir=/usr/lib/\
 --enable-soap  \
 --enable-mbstring=all  \
 --enable-sockets  \
 --enable-fpm \ 

sudo ./nginx -V  nginx查看编译是配置

php版本变化以后ini文件名有变
php.ini-production对应于php.ini-recommended
php.ini-development对应于php.ini-dist


php.ini  datetimezone = PRC


/usr/local/php/etc$ sudo cp ./php-fpm.conf.default ./php-fpm.conf

修改php-fpm 
里面的
user = xieyaokun
group = xieyaokun

php-fpm 关闭：

kill -INT `cat /usr/local/php/var/run/php-fpm.pid`

php-fpm 重启：

kill -USR2 `cat /usr/local/php/var/run/php-fpm.pid`

查看php-fpm进程数：

ps aux | grep -c php-fpm


Ngix 
kill -QUIT 主进程号
快速停止Nginx：
kill -TERM 主进程号
强制停止Nginx：
pkill -9 nginx

</pre>
##rpm的安装
rpm -ivh linuxqq-v1.0.2-beta1.i386.rpm
<pre>
nginx  nginx.conf  修改  
 location ~ \.php$ {
            root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
sudo /usr/local/php/sbin/php-fpm 
sudo /usr/local/nginx/sbin/nginx




cp /lamp/php-5.2.6/php.ini-dist /usr/local/php/etc/php.ini

datezone=PRC



memcache
/usr/local/php/bin/phpize
./configure --with-php-config=/usr/local/php/bin/php-config
make && make install

PDO
/usr/local/php/bin/phpize
./configure --with-php-config=/usr/local/php/bin/php-config --with-pdo-mysql=/usr/bin/mysql
make 
make install


memchached (需要libevent)
./configure --prefix=/usr/local/memcache --with-libevent=/usr/local/libevent/
make && make install
useradd memcache
passwd memcache 密码：123456
* Linux不能用root运行memcache软件
/usr/local/memcache/bin/memcached -umemcache &    
netstat an | grep :11211
telnet 192.168.10.1 11211
stats
写入自启动：
vi /etc/rc.d/rc.local
/usr/local/memcache/bin/memcached -umemcache &

phpmyadmin
cp -r /lamp/phpMyAdmin-3.0.0-rc1-all-languages /usr/local/apache2/htdocs/phpmyadmin
cd /usr/local/apache2/htdocs/phpmyadmin
cp config.sample.inc.php config.inc.php
vi config.inc.php
['auth_type']='http'

vi /usr/local/php/etc/php.ini
添加扩展项
extension_dir = "/usr/local/php//lib/php/extensions/no-debug-non-zts-20060613/"
extension=redis.o
等等



xdebug
usr/local/php/bin/phpize
./configure --enable-xdebug   \
	--with-php-config=/usr/local/php/bin/php-config  
make
make install
vi /etc/


[Xdebug]  
zend_extension ="/usr/local/php5/xdebug/xdebug.so"  
xdebug.profiler_enable=on   
xdebug.trace_output_dir="/usr/local/php5/xdebug/"  
xdebug.profiler_output_dir="/usr/local/php5/xdebug/"  
xdebug.remote_enable=on             
xdebug.remote_handler=dbgp           

xdebug.remote_port=9999 






yum install openssl openssl-devel
openssl
跳转到php源码包ext文件夹
cd openssl
cp config0.m4 config.m4
./configure \
 --with-openssl\
 --with-php-config=/usr/local/php/bin/php-config
 make
 make install

extension=memcache.so
extension=xdebug.so
extension=redis.so
extension=openssl.so
extension=curl.so


curl
yum -y install curl curl-devel
php源码包，ext->curl
/usr/local/php/bin/phpize
./configure \
 --with-curl \
 --with-php-config=/usr/local/php/bin/php-config 
make 
make install
 
 
mysql
yum -y install mysql
yum install -y mysql-devel 
 php源码ext 
/usr/local/php/bin/phpize
./configure \
 --with-php-config=/usr/local/php/bin/php-config 

 make
 make install
 


pdo
/usr/local/php/bin/phpize
./configure \
 --with-pdo-mysql \
 --with-php-config=/usr/local/php/bin/php-config  
 
 
网络方法：
 1. 安装openssl
解压php的源码包
tar zxvf php-5.3.8.tar.gz 
cd soft/php-5.3.8/ext/openssl
 mv config0.m4 config.m4                            否则报错：找不到config.m4
/opt/local/php-5.3.8/bin/phpize 
./configure --with-openssl --with-php-config=/opt/local/php-5.3.8/bin/php-config 
make
make test
make install


编辑php.ini文件增加下面的内容

[openssl]
        extension_dir="/opt/local/php-5.3.8/lib/php/extensions/no-debug-non-zts-20090626/"
        extension="openssl.so"

2.安装curl 扩展
cd soft/php-5.3.8/ext/curl
 /opt/local/php-5.3.8/bin/phpize 
./configure --with-curl  --with-php-config=/opt/local/php-5.3.8/bin/php-config
make
make test
make install

编辑php.ini文件增加下面的内容

[curl]
        extension_dir="/opt/local/php-5.3.8/lib/php/extensions/no-debug-non-zts-20090626/"
        extension="curl.so"

 
 

开发中有3台数据库服务器需要访问和管理，用客户端切换太过麻烦，直接用phpmyadmin来解决问题
修改根目录中的config.inc.php配置
$i = 0;

/*
 * 服务器A
 */
$i++;
/* Authentication type */
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = '127.0.0.1';
$cfg['Servers'][$i]['port'] = '3307';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '123456';
$cfg['Servers'][$i]['bs_garbage_threshold'] = 50;
$cfg['Servers'][$i]['bs_repository_threshold'] = '32M';
$cfg['Servers'][$i]['bs_temp_blob_timeout'] = 600;
$cfg['Servers'][$i]['bs_temp_log_threshold'] = '32M';

/*
 * 服务器B
 */
$i++;
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = '127.0.0.1';
$cfg['Servers'][$i]['port'] = '3308';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = ‘123456';
$cfg['Servers'][$i]['bs_garbage_threshold'] = 50;
$cfg['Servers'][$i]['bs_repository_threshold'] = '32M';
$cfg['Servers'][$i]['bs_temp_blob_timeout'] = 600;
$cfg['Servers'][$i]['bs_temp_log_threshold'] = '32M';


/*
 * 服务器C
 */
$i++;
$cfg['Servers'][$i]['auth_type'] = 'config';
$cfg['Servers'][$i]['host'] = '127.0.0.1';
$cfg['Servers'][$i]['port'] = '3306';
$cfg['Servers'][$i]['connect_type'] = 'tcp';
$cfg['Servers'][$i]['compress'] = false;
$cfg['Servers'][$i]['extension'] = 'mysqli';
$cfg['Servers'][$i]['user'] = 'root';
$cfg['Servers'][$i]['password'] = '123456';
$cfg['Servers'][$i]['bs_garbage_threshold'] = 50;
$cfg['Servers'][$i]['bs_repository_threshold'] = '32M';
$cfg['Servers'][$i]['bs_temp_blob_timeout'] = 600;
$cfg['Servers'][$i]['bs_temp_log_threshold'] = '32M';
 
</pre>