##忘记mysql 密码,重新设置密码：
首先执行
mysqld --skip-grant-tables  如果没有任何输出就对了，不要停止进程

然后新开一个终端
选择数据库 use mysql;
update user set password=password("yun nan kun ming") where user='root'

然后刷新权限: flush privileges;

这样就可以用新密码登陆mysql了  (不确定是不是所有版本都有效)，测试mysql 5.0版本


##mysql 到处数据库表结构(不包含数据，需要-d参数)
mysqldump -uroot -p -d dbname > dbname.sql 

##mysql 导入数据库表结构
登陆mysql
use databasename

source /root/dbname.sql
windows测试环境下入
source C:\Users\mm\Downloads\yueloo.sql;
 


##mysql 导出数据不包含表结构
mysqldump -uroot -p -B DBNAME --table table_name > table_name.sql


mysql 时间输出

  比如
  select articleid,articlename,from_unixtime(postdate,'%Y-%m-%d'),from_unixtime(lastupdate,'%Y-%m-%d') from jieqi_article_article where articleid in(62393,62406,62390,62376,62391);
  
  from_unixtime() 时间戳输出格式为年月日
  
  UNIX_TIMESTAMP() 你那月是转化为时间戳
  date_formate(now(),'%Y-%m-%d');
  
  
  按条件到处数据
  mysqldump -uroot -p sq_yueloo jieqi_pooling_article  --where=' articleid in (40042,62323,62322)' > /www/test.yueloo.com/test.sql
  
  
  mysql 导出数据
  方法一：SELECT...INTO OUTFILE
mysql> select * from mytbl into outfile '/tmp/mytbl.txt';
Query OK, 3 rows affected (0.00 sec)
查看mytbl.txt中内容如下：
mysql> system cat /tmp/mytbl.txt
1       name1
2       name2
3       \N

导出的文件中数据以制表符分隔，以"\n"为换行符
mysql> system od -c /tmp/mytbl.txt
0000000   1  \t   n   a   m   e   1  \n   2  \t   n   a   m   e   2  \n
0000020   3  \t   \   N  \n
0000025

也可以自己制定分隔符和换行符
导出成csv格式
mysql> select * from mytbl into outfile '/tmp/mytbl2.txt' fields terminated by ',' enclosed by '"' lines terminated by '\r\n';
Query OK, 3 rows affected (0.01 sec)

mysql> system cat /tmp/mytbl2.txt
"1","name1"
"2","name2"
"3",\N

导出的文件一定不能已经存在。（这有效的防止了mysql可能覆盖重要文件。）
导出时登录的mysql账号需要有FILE权限
null值被处理成\N
缺点：不能生成包含列标签的输出

方法二：重定向mysql程序的输出
[root@localhost ~]# mysql -uroot -p -e "select * from mytbl" --skip-column-names test>/tmp/mytbl3.txt
Enter password: 
[root@localhost ~]# cat /tmp/mytbl3.txt 
1       name1
2       name2
3       NULL
--skip-column-names 去掉列名行

[root@localhost ~]# od -c /tmp/mytbl3.txt
0000000   1  \t   n   a   m   e   1  \n   2  \t   n   a   m   e   2  \n
0000020   3  \t   N   U   L   L  \n
0000027

导出成csv格式
[root@localhost ~]#  mysql -uroot -p -e "select * from mytbl" --skip-column-names test|sed -e "s/[\t]/,/" -e "s/$/\r/">/tmp/mytbl4.txt
Enter password: 
[root@localhost ~]# od -c /tmp/mytbl4.txt 
0000000   1   ,   n   a   m   e   1  \r  \n   2   ,   n   a   m   e   2
0000020  \r  \n   3   ,   N   U   L   L  \r  \n

null值被处理成字符串"NULL"

方法三：使用mysqldump来导出
mysqldump程序用于拷贝或者备份表和数据库。它能够将表输出写成一个文本数据文件，或者一个用于重建表行的insert语句集。
[root@localhost ~]# mysqldump -uroot -p --no-create-info --tab=/tmp test mytbl
mysqldump使用表名加上一个.txt后缀来创建一个数据文件，所以此命令写入一个名为/tmp/mytbl.txt的文件

导出成csv格式
[root@localhost ~]# mysqldump -uroot -p --no-create-info --tab=/tmp --fields-enclosed-by="\"" --fields-terminated by="," --lines-terminated-by="\r\n" test mytbl tbl
同时导出了mytbl，tbl两张表，数据库名后面跟多张表则导出多个表到对应文件，如果没有表，则导出数据库中的所有表。

null值被处理成\N 


 总结：对null的处理需求不同，可以选择不同的导出方式。方法三导出的文件名是固定的，对于文件名有特殊要求的情况，不适宜使用，方法三也只能导出整张表。

 方法二可以和linux命令结合使用，灵活性比较大。