#禁止某ip访问
iptables  -I INPUT -s 177.43.213.35 -j DROP 




错误	1	error C4996: '_itoa': This function or variable may be unsafe. Consider using _itoa_s instead. To disable deprecation, use _CRT_SECURE_NO_WARNINGS. See online help for details.	c:\users\mm\documents\visual studio 2013\projects\3.3作业\3.3作业\进制.c	9	1	3.3作业



iptables -L  --line-numbers 显示所有iptables规则
查看Ip流量
 iptables -L -n -v 

 #资料
http://blog.csdn.net/kobejayandy/article/details/24332597