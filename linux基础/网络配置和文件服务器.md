```
补充：
	IP地址：	IPv4		2*32=42亿9千万
			IPv4		2*128

			11111111.11111111.11111111.11111111
			0.0.0.0	-	255.255.255.255

		分类：	A-E

			A类： 1.0.0.0		-	126.255.255.255	子网掩码	255.0.0.0		11111111.0.0.0
			B类： 128.0.0.0	-	191.255.255.255			255.255.0.0		11111111.11111111.0.0
			C类： 192.0.0.0	-	223.255.255.255			255.255.255.0		11111111.11111111.11111111.0

			127.0.0.1	本机回环地址

			10.0.0.0	-	10.255.255.255	一个网段
			172.16.0.0	-	172.31.255.255	十六个网段
			192.168.0.0	-	192.168.255.255	256个网段


	常见网络端口：
		20  21		ftp服务		文件共享
		22		ssh服务		安全远程网络管理，加密发送
		23		telnet服务	远程管理工具，但是是明文发送
		25 		smtp：简单邮件传输协议	发信
		110		pop3：邮局协议			收信
		80		www		网页服务
		3306		mysql端口
		53		DNS端口
		
		/etc/services			所有系统常见端口

		端口数量 	tcp  65535		udp  65535

		telnet  ip  端口	测试端口是否可以正常连接
			ctrl+]  -----------  quit		退出方式

		netstat  -tlun  	查看本机所有监听端口
			-t  tcp  -u udp   -l  监听  -n  以IP和端口号显示

	网络配置 

	一	IP地址配置

		1	setup
		
			service network  restart

		2	ifconfig  eth0  ip  netmask  掩码			临时生效


	

	补充：	DNS	域名系统	Domain  name  system			端口：tcp  udp  53

		作用：	www.sina.com-----------------202.108.33.32

			域名-----IP			正向解析
			IP-------域名			反向解析			DNS

			北京常用DNS	网通		202.106.0.20
					电信		219.141.136.10

			www.sina.com.cn./dgasgsa/gdsadsoo?$	
			域名分级：
				根域名		.		固定的13台
				一级域名	组织一级域	。com	。net	。gov		地区一级域	.cn	.hk	.tw	互联网管理机构认定
				二级域名	个人或公司主动申请的，全球唯一的
				三级域名	个人或公司自主定义的。www


		hosts		静态域名解析文件

				windows	C:\WINDOWS\system32\drivers\etc\hosts	
				linux		/etc/hosts			

	RAM
	ROM

		3	网卡配置文件

			1）/etc/sysconfig/network-scripts/ifcfg-eth0			网卡信息文件
		
DEVICE=eth0					网卡设备名
BOOTPROTO=none				是否自动获取IP。none：不生效		static：手动		dhcp：动态获取IP
BROADCAST=192.168.140.255			广播地址
HWADDR=00:0c:29:21:80:48			mac地址,网卡物理地址。48位
IPADDR=192.168.140.253			IP地址
IPV6INIT=yes					IPv6开启
IPV6_AUTOCONF=yes				IPv6获取
NETMASK=255.255.255.0			掩码
NETWORK=192.168.140.0			网段
ONBOOT=yes					网卡开机启动
TYPE=Ethernet					以太网
GATEWAY=192.168.140.1			网关

			2）/etc/sysconfig/network			主机名配置文件		永久生效，但是要重启
				HOSTNAME=localhost.localdomain

				hostname  sc			临时设定主机名
				hostname			查看主机名

			3）/etc/resolv.conf			DNS配置文件

				nameserver  202.106.0.20

	二	网络命令

		1	ifconfig		查看网卡信息

			
		2	ifup  eth0		ifdown  eth0		快速开启和关闭网卡 

		
		3	netstat  -an			查看所有网络连接
			netstat  -tlun		查看tcp和udp协议监听端口
			netstat  -rn			查看路由	default：默认路由（网关）

		4	route				查看路由

			route  add   default  gw  192.168.140.1			手工设定网关，临时生效
			route del default gw 192.168.190.6				删除网关

		5	ping  ip			探测网络通畅


		7	traceroute  ip或域名		探测到底目的地址的路径（linux命令）

				tracert  ip		windows下命令

		8	telnet  ip  端口		探测端口开启

		9	tcpdump -i eth0  -nnX  port 21
				-i  指定监听网卡
				-nn 以ip和端口显示
				-X	十六进制分析包
				port  21	监听指定端口


	

VSFTP服务

		
	一	文件服务器简介

		ftp：在内网和公网使用。	服务器：windows，linux	客户端：windows，linux

		samba：只能在内网使用	（文件共享服务）	服务器：windows，linux	客户端：windows（linux）

		NFS:在公网和内网		服务器：Linux			客户端：Linux

		http：在内网和公网		服务器：windows，linux	客户端：windows，linux




			1	ftp软件

				linux：	wu-ftp			早期，不太安全
						proftp		增强ftp工具
						vsftp		安全，强大

				windows	IIS		windows下网页搭建服务，可以搭建ftp服务
						Serv-U		专用ftp服务器

			2	原理

					开启 	21  	命令传输端口
						20	数据传输端口

			3	ftp的用户
				1）ftp允许登录用户	就是系统用户	使用密码也是系统密码
					上传位置：/home/家目录

				2）匿名用户	anonymous	密码：  空   或者  邮箱地址	  11@aa
					上传位置：/var/ftp/


		二	安装

			rpm  -ivh  vsftpd...........
			yum  install  vsftpd  -y

		三 	相关文件

			/etc/vsftpd/vsftpd.conf		配置文件

			/etc/vsftpd/ftpusers			用户访问控制文件		写入此文件的用户都不能访问ftp服务器
			/etc/vsftpd/user_list

			/etc/vsftpd/chroot_list		需要手工建立		定义是否把用户限制在家目录

		四	配置文件配置

			/etc/vsftpd/vsftpd.conf

			1	主机相关配置
				listen_port=21			监听端口
				connect_from_port_20=YES		数据传输端口
				ftpd_banner=				欢迎信息


			2	匿名用户登录			在linux下识别为  ftp  用户

				anonymous_enable=YES			允许匿名用户登录


			3	本地用户
				local_enable=YES			允许系统用户登录
				write_enable=YES			允许上传
				local_umask=022			默认上传权限
				local_max_rate=300			上传限速

			4	限制用户访问目录
				chroot_local_user=YES		只有此句，所有用户限制在家目录下

				chroot_local_user=YES		如有三句话，只有文件chroot_list中的用户可以访问任何目录，其他用户限制在家目录
				chroot_list_enable=YES
				chroot_list_file=/etc/vsftpd/chroot_list	

			注意：配置文件关键字后面不能有空格		


	五	ftp客户端使用

		ftp  ip

			get  文件名		下载
			put  文件名		上传		不能上传和下载目录

	
samba服务器				

		（一）简介

			文件服务器 
			
		（二）端口
			smbd：	为clinet提供资源访问		tcp  139  445

			nmbd：提供netbios主机名解析的	upd  137  138

		（三）安装相关程序

			samba		主程序包

			samba-common		主要配置文件

			samba-client		客户端文件
			
		（四）相关文件

			/etc/samba/smb.conf		配置文件		#  和  ；注释

		(五)服务器段配置

			vi  /etc/samba/smb.conf

			[global]
				workgroup  =  工作组

				server  string  =  描述

				log  file  =	日志位置

				max  log  size  =  日志最大大小 			KB

				security  =  user		安全等级
						user	使用samba用户登录。注意：samba用户由系统用户转变过来。要把用户生成为samba用户，此用户必须已经是系统							用户，保护了用户的系统密码
						share	不用密码
						server	使用验证服务器验证
						domain	域控制器验证

			share   definitions		共享设置

				[共享目录名]
					comment  =  目录描述
					browseable  =  yes		目录是否对用户可见
					writeable  =  yes		可写（要与系统目录权限相与）
					valid  users  =  用户名	用户限制（目录是哪个用户所有）
					path  =  /www			指定共享目录位置


			例子：
				共享两个目录，一个是pub    位置在 /pub	所有用户都能访问，所有用户都能上传

						/soft	位置在  /soft		只有aa用户能访问，上传。其他用户不能访问

			       
[pub]
        comment = all access
        browseable = yes
        path = /pub
        writable = yes
[soft]
        browseable = yes
        path = /soft
        writable=yes

			mkdir  /pub
			mkdir  /soft
			chmod 777 /pub
			chmod 700 /soft
			chown aa  /soft

			service smb  restart

		（六）	把系统用户声明为samba用户

			smbpasswd  -a  系统用户名
			smbpasswd  -a  aa

			smbpasswd  -x  用户名		删除samba用户

		（七）	重启服务
			service  smb  restart
			
				注意：	samba权限和系统权限取最严格权限
					samba用户必须是系统用户
					启动的服务名是smb

		

		（八）	客户端使用

				windows：	共享目录
						net  use  *  /del			删除缓存

				linux客户端：
					smbclient  //192.168.140.253/soft -U aa

文件服务器总结：
	1	vsftp	服务器：linux  windows   客户端：linux  windows    使用范围：内网  外网
			共享目录：普通用户是用户家目录，匿名用户是/var/ftp/目录。不能手工指定
			登录用户：系统用户，使用系统密码登录

	
	3	samba：服务器：linux	windows	客户端:linux  windows	使用范围：内网
			共享目录：手工指定
			登录用户：系统用户,使用samba密码登录


ssh安全登录			22端口

	一	联机加密工具
		非对称钥匙对加密

		安装		默认安装		openssh

		启动		默认开机自启动		service  sshd  restart




	二	ssh远程安全联机		掌握

		ssh   用户名@ip

	三	scp	网络复制，网络文件传输			掌握

		1	下载

			scp   用户名@ip:路径   本地路径

			scp  root@192.168.140.93:/root/abc  /root

			scp  -r  root@192.168.140.93:/root/11  /root		下载目录

		2	上传
			scp  本地文件或目录  用户名@ip:路径

			scp  -r  /root/11  root@192.168.140.93:/root		上传目录

	
			


补充 centos 6.3 ip ifconfig 改变为ipddr


































```