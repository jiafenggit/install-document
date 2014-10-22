#apache配置
关键配置打开重写功能
<Directory "/usr/local/apache2/htdocs/yueloo" >
    # enable the .htaccess rewrites
    AllowOverride All
    Require all granted
</Directory>

添加php支持：
 AddType text/html .shtml
 Addtype application/x-httpd-php .php .phtml .phps

##apache访问日志按天生成
<pre>

      CustomLog "logs/access.log" common  原来的样子

      ErrorLog "logs/error.log"            原来的样子

      CustomLog "|/usr/local/apache2/bin/rotatelogs /var/logs/logfile 86400" common   修改后的样子

      CustomLog "|/usr/local/apache2/bin/rotatelogs /var/logs/logfile 5M" common   修改后的样子

      ErrorLog "|bin/rotatelogs /var/logs/errorlog.%Y-%m-%d-%H_%M_%S 5M"


	  参考网站：
	  http://zhumeng8337797.blog.163.com/blog/static/10076891420121951235106/

	  错误日志：ErrorLog "|/data/apache/bin/rotatelogs 日志存放目录/%Y%m%d_error.log 86400 480"
	  访问日志：CustomLog "|/data/apache/bin/rotatelogs 日志存放目录/%Y%m%d_access.log 86400 480" common

	 按照天生成apache日志最终结果：
      CustomLog "|/usr/local/apache2/bin/rotatelogs /usr/local/apache2/logs/%Y%m%d_access.log 86400 480" common
	  ErrorLog  "|/usr/local/apache2/bin/rotatelogs /usr/local/apache2/logs/%Y%m%d_error.log 86400 480"
		
		
</pre>


###配置apache manifest
AddType text/cache-manifest manifest



阿里云 日志设置
CustomLog "|/usr/local/work/apache/bin/rotatelogs /www/logs/%Y%m%d_access.log 86400 480" common

ErrorLog  "|/usr/local/work/apache/bin/rotatelogs /www/logs/%Y%m%d_error.log 86400 480"