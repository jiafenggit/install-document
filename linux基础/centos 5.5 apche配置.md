```
512kbps=56kbit/s+8=64kB/s

56kbps=7KB/s


第十四章	Apache服务器

	一	简介

		1	www：world  wide  web	万维网

			http	协议：	超文本传输协议

			HTML语言：	超文本标识语言

		2	URL：统一资源定位		协议+域名：端口+网页文件名
					http://www.sina.com.cn:80/11/index.html
					www.sina.com.cn

		3	搭建www的服务器的方法
				windows  	IIS+asp+SQLserver
						Internet  Information  server
				Linux		apache+mysql+php

	二	安装
		1、lamp源码安装	

			wamp	

		2、rpm包安装
			httpd
			mysql
			mysql-server		
			php
			php-devel
			php-mysql

	三	相关文件

		apache配置文件
			源码包安装：/usr/lcoal/apache2/etc/httpd.conf
				    /usr/local/apache/etc/extra/*.conf
				    
			rpm包安装：/etc/httpd/conf/httpd.conf

		默认网页保存位置：
			源码包：/usr/local/apache2/htdocs/
			rpm包安装：/var/www/html/

		日志保存位置
			源码包：/usr/local/apache2/log/
			rpm包： /var/log/httpd/

	四	配置文件
		
		注意：apache配置文件严格区分大小写

		1	针对主机环境的基本配置

		ServerRoot		apache主目录
		Listen			监听端口
		LoadModule		加载的相关模块
		
		User
		Group			用户和组
		ServerAdmin		管理员邮箱
		ServerName		服务器名（没有域名解析时，使用临时解析。不开启）
		ErrorLog "logs/error_log	错误日志
		DirectoryIndex index.html index.php		默认网页文件名,优先级顺序
		Include  etc/extra/httpd-vhosts.conf		子配置文件中内容也会加载生效
		
		2	主页目录及权限

			DocumentRoot "/usr/local/apache2//htdocs"
				主页目录

			<Directory "/usr/local/apache2//htdocs">
				#Directory关键字定义目录权限

				Options Indexes FollowSymLinks
					#options 
						None：没有任何额外权限
						All：所有权限
						Indexes：	浏览权限（当此目录下没有默认网页文件时，显示目录内容）
						FollowSymLinks：准许软连接到其他目录
				AllowOverride None
					#定义是否允许目录下.htaccess文件中的权限生效
						None：.htaccess中权限不生效
						All：文件中所有权限都生效
						AuthConfig：文件中，只有网页认证的权限生效。
				Order allow,deny		访问控制列表
    				Allow from all
					#定义此目录的允许访问权限
						例1：	允许所有，拒绝特殊
							Order allow,deny			权限顺序是先实现允许权限，再实现拒绝权限		
							allow  from  all			允许权限是允许所有
							deny  from  192,168.150.254		拒绝权限是拒绝254

						例2：拒绝所有，允许特殊
							Order deny,allow			权限顺序是先实现拒绝权限，再实现允许权限
							deny  from  all			拒绝权限时拒绝所有
							allow from  192.168.150.0/24	允许权限是允许150网段
			</Directory>


			

		3	目录别名
子配置文件名	etc/extra/httpd-autoindex.conf

Alias /icons/ "/usr/local/apache2//icons/"
    apache以为在这里		实际目录位置
	定义别名  /icons/----
		http://192.168.1.253/icons/

<Directory "/usr/local/apache2//icons">
    Options Indexes MultiViews			MultiViews多编码支持
    AllowOverride None
    Order allow,deny
    Allow from all
</Directory>


Alias /soft/ "/www/soft/"

<Directory "/www/soft">
    Options Indexes MultiViews
    AllowOverride None
    Order allow,deny
    Allow from all
</Directory>

		4	用户认证
		限制特定目录，只有指定用户可以访问。

		1）	建立需要保护的目录

			①在/usr/local/apache2/htdocs/11下建立目录，然后保护

			②使用别名，在系统位置建立目录，然后保护

				mkdir  -p  /www/soft

		2)修改配置文件，允许权限文件生效
		vi  /usr/local/apache2/etc/httpd.conf
Alias /soft/ "/www/soft/"

<Directory "/www/soft">
    Options Indexes 
    AllowOverride All			#开启权限认证文件.htaccess
    Order allow,deny
    Allow from all
</Directory>

		重启apache

		3）在指定目录建立权限文件
		cd  /www/soft

		vi  .htaccess
AuthName "50 docs"
	#提示信息
AuthType basic
	#加密类型
AuthUserFile /www/apache.passwd
	#密码文件，文件名自定义。
require valid-user
	#允许密码文件中所有用户访问

		4）建立密码文件，加入允许访问的用户。用户和系统用户无关
		/usr/local/apache2/bin/htpasswd  -c  /www/apache.passwd  test1
			-c  建立密码文件，只有添加第一个用户时，才能-c
		/usr/local/apache2/bin/htpasswd  -m  /www/apache.passwd  test2
			-m  再添加更多用户时，

	5	虚拟主机

		xeon  *2	

		
		1）分类
			基于IP的虚拟主机:	一台服务器，多个IP，搭建多个网站
			基于端口的虚拟主机	一台服务器，一个ip，搭建多个网站，每个网络使用不同端口访问
			基于名字的虚拟主机	一台服务器，一个ip，搭建多个网站，每个网站使用不同域名访问

		2）步骤：
			①	解析试验域名
				www.sina.com
				www.sohu.com

			②	规划网站主目录
				/www/sina--------------www.sina.com
				/www/sohu ------------ www.sohu.com

			③ 	修改配置文件
				vi  /usr/local/apache2/etc/httpd.conf
					Include etc//extra/httpd-vhosts.conf
						#打开虚拟主机配置文件
				vi /usr/local/apache2/etc/extra/httpd-vhosts.conf

NameVirtualHost 192.168.150.253
						#启动虚拟主机，指定虚拟主机ip

<Directory "/usr/local/apache2/htdocs/sina">
    Options Indexes
    AllowOverride None
    Order allow,deny
    Allow from all
</Directory>

<Directory "/usr/local/apache2/htdocs/sohu">
    Options Indexes
    AllowOverride None
    Order allow,deny
    Allow from all
</Directory>

<VirtualHost 192.168.150.253>
	#注意，只能写ip
    ServerAdmin webmaster@sina.com
		#管理员邮箱
    DocumentRoot "/usr/local/apache2/htdocs/sina"
		#网站主目录
    ServerName www.sina.com
		#完整域名
    ErrorLog "logs/sina-error_log"
		#错误日志
    CustomLog "logs/sina-access_log" common
		#访问日志
</VirtualHost>

<VirtualHost 192.168.150.253>
    ServerAdmin webmaster@sohu.com
    DocumentRoot "/usr/local/apache2/htdocs/sohu"
    ServerName www.sohu.com
    ErrorLog "logs/sohu.com-error_log"
    CustomLog "logs/sohu.com-access_log" common
</VirtualHost>
				

	6	rewrite	重写功能
		在URL中输入一个地址，会自动跳转为另一个

		1）域名跳转	www.sina.com  ------>  www.sohu.com

			开启虚拟主机，并正常访问 

			修改配置文件，使sina目录的。htaccess文件生效
<Directory "/www/sina">
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>

			vi  /www/sina/.htaccess
RewriteEngine on
	#开启rewrite功能
RewriteCond %{HTTP_HOST} ^www.sina.com
	把以www.sina.com	开头的内容赋值给HTTP_HOST变量
RewriteRule  .*   http://www.sohu.com
	.*  输入任何地址，都跳转到http://www.sohu.com


		2）静态网页向动态网页跳转
修改配置文件
<Directory "/usr/local/apache2/htdocs/sohu">
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>


vi  /usr/local/apache2/htdocs/sohu/.htaccess
RewriteEngine on

RewriteRule index(\d+).html index.php?id=$1
	#	输入index(数值).html时，跳转到index.php文件，同时把数值当成变量传入index.php



	7	常用子配置文件

		httpd-autoindex.conf			apache系统别名

		httpd-default.conf			线程控制			*

		httpd-info.conf			状态统计网页

		httpd-languages.conf			语言编码			*

		httpd-manual.conf			apache帮助文档

		httpd-mpm.conf			最大客户端限制			*

		httpd-multilang-errordoc.conf	报错页面			*

		httpd-ssl.conf			ssl安全套接字访问

		httpd-userdir.conf			用户主目录配置

		httpd-vhosts.conf			虚拟主机


	


```