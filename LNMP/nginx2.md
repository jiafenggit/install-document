###NGINX停止
<pre>
参考http://www.2cto.com/os/201110/108397.html

ps -ef | grep nginx

步骤1：查询nginx主进程号
ps -ef | grep nginx
在进程列表里面找master进程，它的编号就是主进程号了。
步骤2：发送信号
从容停止Nginx：
kill -QUIT 主进程号
快速停止Nginx：
kill -TERM 主进程号
强制停止Nginx：
pkill -9 nginx
</pre>


###php-fpm
<pre>
参考：http://www.cnblogs.com/argb/p/3604340.html
kill -USR2 [pid]


关闭php-fpm
kill -INT `cat /usr/local/php/var/run/php-fpm.pid`
 
重启php-fpm
kill -USR2 `cat /usr/local/php/var/run/php-fpm.pid`
</pre>