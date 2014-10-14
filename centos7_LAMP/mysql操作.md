<Pre>
1.导出整个数据库 
　　mysqldump -u 用户名 -p 数据库名 > 导出的文件名 
　　mysqldump -u wcnc -p smgp_apps_wcnc > wcnc.sql 
　　2.导出一个表 
　　mysqldump -u 用户名 -p 数据库名 表名> 导出的文件名 
　　mysqldump -u wcnc -p smgp_apps_wcnc users> wcnc_users.sql 
　　3.导出一个数据库结构 
　　mysqldump -u wcnc -p -d --add-drop-table smgp_apps_wcnc >d:wcnc_db.sql 
　　-d 没有数据 --add-drop-table 在每个create语句之前增加一个drop table 



D:\> mysqldump -uroot -p -hlocalhost -P3306 -n -d -t -R DBName > procedure_name.sql
参数说明：
-n: --no-create-db
-d: --no-data
-t: --no-create-info
-R: --routines Dump stored routines (functions and procedures)
只导出存储过程和函数。

</pre>
<pre>
查看当前目录占用空间最大的前十个文件或者文件夹
du -sh *|sort -nr|head
</pre>

#apache 日志文件处理
<pre>
一步：停止Apache服务的所有进程，删除 Apache2/logs/目录下的 error.log、access.log文件 

第二步：打开 Apache 的 httpd.conf配置文件并找到下面两条配置 

ErrorLog logs/error.log 
CustomLog logs/access.log common 

直接注释掉，换成下面的配置文件。 


# 限制错误日志文件为 1M 
ErrorLog "|bin/rotatelogs.exe -l logs/error-%Y-%m-%d.log 1M” 

# 每天生成一个错误日志文件 
#ErrorLog "|bin/rotatelogs.exe -l logs/error-%Y-%m-%d.log 86400" 

# 限制访问日志文件为 1M  
CustomLog "|bin/rotatelogs.exe -l logs/access-%Y-%m-%d.log 1M” common 

# 每天生成一个访问日志文件 
#CustomLog "|bin/rotatelogs.exe -l logs/access-%Y-%m-%d.log 86400" common
</pre>

###mysql导出csv
<pre>
select * from jieqi_article_article into outfile "/www/mysql/output.csv" fields terminated by ',' optionally enclosed by '' lines terminated by '/r/n';
</pre>


* mysql表结构 
>desc tablename;

* mysql查看创建表语句
>show create table tablename;