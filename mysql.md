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