mongdb 


复制mongodb 整个目录到制定的目录
创建数据目录
mkdir ./data/db
创建日志文件
mkdir ./data/bd/log/mongodb.log

启动mongodb  
/usr/local/mongodb/bin/mongod   --dbpath ./data/db1  --logpath ./data/db1/log/mogondb.log --fork