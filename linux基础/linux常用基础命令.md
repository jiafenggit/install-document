```

Linux当中所有内容以文件形式保存，包括系统硬件

eth0		第一块网卡
eth1		第二块网卡

/dev/sda1	/	根目录		/dev	特殊文件目录		/dev/sda1	sd:  SCSI   SATA   hd: IDE		
											a:  第一块硬盘		1： 第一个分区	
/dev/sdc5
/dev/hdb3


IP地址  配置：
	setup			调用setup工具

	service  network  restart		重启网络服务

	ifconfig		查看IP信息

管理员		root
提示符		[root@localhost ~]#
		[登录用户@主机名 当期所在目录]#
		~	家目录		/root	root的家目录			/home/aa  aa用户的家目录

		#  超级用户	
		$  普通用户
		
密码原则
	复杂性 	易记忆性  时效性 

	wmzxdlxx
	wm2xd_LXX hongchen()()

Linux中所有内容都是文件，包括硬件
Linux不以扩展名区分文件类型，
Linux严格区分大小写


	Linux常见命令(一)

	一 	                             linux命令的格式

		1、命令  [选项]  [参数]

		ls	list	显示目录下内容 ll(是ls -l的别名)

		①	命令名称：ls
			命令英文原意：list
			命令所在路径：/bin/ls
			执行权限：所有用户
			功能描述：显示目录文件

		②	ls	名直接回车，显示目录下内容

		ls  -l			长格式显示		(缩略选项用一个减号，完整选项用两个减号)


		-rw-------    1   root    root    1190    08-10 23:37     anaconda-ks.cfg
		第一项：		权限位	
		第二项：  1		引用计数
		第三项：  root		属主
		第四项：  root   	属组
		第五项：  		大小	块
		第六项			最后一次修改时间
		第七项			文件名

		ls  -a   	显示所有文件（包含隐藏文件）
		 ls  -al
		ls  -h		文件大小显示为常见大小单位	B	KB	MB

		ls  -l  文件名		

	二 	文件和目录操作命令

		1	目录操作命令

			1）	cd	切换所在目录

				①	命令名称：cd
					命令英文原意：change directory
					命令所在路径：shell内置命令				/bin/bash
					执行权限：所有用户


				②cd  /usr/local/src
  
				相对路径：参照当前所在目录，进行查找。一定要先确定当前所在目录。    root]#cd  ../usr/local/src
				绝对路径：cd  /usr/local/src		从根目录开始指定，一级一级递归查找。在任何目录下，都能进入指定位置

				cd  ~		进入当前用户的家目录		/root		/home/aa/
				cd		
				cd  -		进入上次目录
				cd  ..		进入上一级目录
				cd  .		进入当前目录

			2)	pwd	显示当前所在目录
				命令名称：pwd
				命令英文原意：print working directory
				命令所在路径：/bin/pwd
				执行权限：所有用户

			3）	linux常见目录
				/		根目录
				/bin		命令保存目录（普通用户就可以读取的命令）
				/boot		启动目录，启动相关文件
				/dev		设备文件保存目录
				/etc		配置文件保存目录
				/home		普通用户的家目录
				/lib		系统库保存目录
				/mnt		系统挂载目录
				/media		挂载目录
				/root		超级用户的家目录
				/tmp		临时目录
				/sbin		命令保存目录（超级用户才能使用的目录）
				/proc		直接写入内存的
				/sys		
				/usr		系统软件资源目录(unix system root )
					/usr/bin/		系统命令（普通用户）
					/usr/sbin/		系统命令（超级用户）
				/var		系统相关文档内容	(可变的）
					/var/log/		系统日志位置
					/var/spool/mail/		系统默认邮箱位置
					/var/lib/mysql/
				
			4）	建立目录
				mkdir  目录名
				命令名称：mkdir
				命令英文原意：make directories
				命令所在路径：/bin/mkdir
				执行权限：所有用户

				mkdir  -p  11/22/33/44		递归建立目录
			
			5）	删除目录
				rmdir  目录			只能删除空目录
				命令名称：rmdir
				命令英文原意：remove empty directories
				命令所在路径：/bin/rmdir
				执行权限：所有用户

				rm  文件名		删除文件

				rm  -rf   目录	删除文件和目录
					-r  递归，删除目录
					-f  强制

			6）  tree  目录名	显示指定目录下所有内容的目录树
				命令名称：tree
				命令所在路径：/usr/bin/tree
				执行权限：所有用户
date		查看系统时间
date  -s  20130115		修改日期
date  -s  15:25:40		修改时间


		2	文件操作命令

			1）创建空文件或修改文件时间

				touch  文件名
				命令名称：touch
				命令所在路径：/bin/touch
				执行权限：所有用户 二次创建，会修改 创建时间。

			2）删除
				rm  -rf  文件名
				命令名称：rm
				命令英文原意：remove
				命令所在路径：/bin/rm
				执行权限：所有用户


			3）cat  文件名		查看文件内容。从头到尾
				命令名称：cat
				命令所在路径：/bin/cat
				执行权限：所有用户

				-n	列出行号

			4）more  文件名	分屏显示文件内容
				命令名称：more
				命令所在路径：/bin/more
				执行权限：所有用户


				空格向下翻页			b   向上翻页		q  退出

			6） head  文件名 	显示文件头
				命令名称：head
				命令所在路径：/usr/bin/head
				执行权限：所有用户
		
				head  -n  行数   文件名		指定显示文件头几行
				head  -n  20  文件名
				head  -20  文件名

			7）tail  -n  行数  文件名		显示文件尾
				  -f		监听文件尾，不退出。适合监听实时文件
				命令名称：tail
				命令所在路径：/usr/bin/tail
				执行权限：所有用户

				ctrl +  c		强制终止
				ctrl+l			清屏



		3	文件和目录都能操作的命令

			1）rm		删除文件或目录 -rf   r(递归) f(强制)   复制目录需要加上-r选项

			2）复制
			命令名称：cp
			命令英文原意：copy
			命令所在路径：/bin/cp
			执行权限：所有用户


			cp  源文件  目标位置

				-r  复制目录
				-p	连带文件属性复制
				-d	若源文件是链接文件，则复制链接属性
				-a	相当于  {-pdr（以上三个选项的集合）}

			cp  aa  /tmp/		原名复制
			cp  aa  /tmp/bb		改名复制


			3）剪切或改名 （移动目录或文件是不需要-r参数，既可以操作目录也可以操作文件）
			命令名称：mv
			命令英文原意：move
			命令所在路径：/bin/mv
			执行权限：所有用户

			mv  源文件  目标位置

			mv  /root/aa  /tmp/

			mv  aa  bb		重命名


		5	链接文件//使用绝对路径		
			ln
			命令名称：ln
			命令英文原意：link
			命令所在路径：/bin/ln
			执行权限：所有用户

					
			inode	i节点
			block	数据块

				软链接		符号链接
					快捷方式
					新建的链接，占用不同的硬盘位置
					修个任何一个文件，两都改变
					删除源文件，软连接打不开
	
			
					ln  -s  源文件  目标文件		文件名都必须写绝对路径


1

		2	修改权限			重点
			chmod
			命令名称：chmod
			命令英文原意：change the permissions mode of a file
			命令所在路径：/bin/chmod
			执行权限：所有用户

			chmod  u+x  aa		aa文件的属主加上执行权限
			chmod  u-x  aa
			chmod  g+w,o+w  aa
			chmod  u=rwx  aa

			chmod  755  aa		
			chmod  644  aa

		3	权限意义：
			1）权限对文件的含义
				r：读取文件内容
				w：编辑、新增、修改文件内容
				   但是不包含删除文件
				x：可执行
			/tmp/11/22/abc   ---------    
				
			2）权限对目录的含义
				r：可以查询目录下文件名
				w：具有修改目录结构的权限。如新建文件和目录，删除此目录下文件和目录，重命名此目录下文件和目录，剪切
				x：可以进入目录

		4	属主和属组命令
			chown （change owner）
			命令名称：chown
			命令英文原意：change file ownership
			命令所在路径：/bin/chown
			执行权限：所有用户

			chown  用户名  文件名		改变文件属主

			chown  user1  aa		user1必须存在

			chown  user1:user1  aa	改变属主同时改变属组

			useradd  用户名 		添加用户
			passwd  用户名			设定用户密码			

			chgrp  属组名  文件名		改变属组
			命令名称：chgrp
			命令英文原意：change file group ownership
			命令所在路径：/bin/chgrp
			执行权限：所有用户




	四	帮助命令
		1	man  命令名			查看命令的帮助	
			命令名称：man
			命令英文原意：manual
			命令所在路径：/usr/bin/man
			执行权限：所有用户

			man  5  passwd
	
		2	命令  --help			查看命令的常见选项

常用命令（二）（不能关机，按照规定目录执行操作，不能执行高负载的命令在大量访问的时候比如19点到24点之间）
	
	一	查找命令 whoami  (我是谁)

		1	which  命令名			查找命令的命令，能看到相关别名
			命令名称：which
			命令所在路径：/usr/bin/which
			执行权限：所有用户

		2	whereis  命令名		查找命令的命令，同时看到帮助文档位置	(只能查看命令，不能查看普通命令)
			命令名称：whereis	
			命令所在路径：/usr/bin/whereis
			执行权限：所有用户

		3	find				搜索命令	在系统中查找符合条件的文件名（）		
			命令名称：find
			命令所在路径：/usr/bin/find
			执行权限：所有用户

			按照文件名查找	（完全匹配文件名）
			find  查找位置   -name  文件名
			find  /  -name  aabbcc		按照文件名查找（尽量不要使用根来搜索，速度慢）


			按照用户
			-user  用户名		按照属主用户名查找文件
			-group  组名		按照属组组名查找文件
			-nouser		找没有属主的文件 { （只有u盘里的数据，光盘，还有内存部分，其他的都是垃圾文件。）/proc 和/sys /mnt/cdrom这三个目录无所有者}
		
			find  /  -nouser

			按照文件权限
			-name			按照文件名
			-size			按照文件大小。+50k：大于50k，-50k：小于50k，50k：等于50k k（小写） M（大写） 一定要有单位，否则按块（512b）查找
			find  /  -size  +50k
			-type 类型 		安装文件类型查找	f：普通		d：目录		l：链接

			-inum  			安装i节点查找(inode 是分区表里的id号) 知道id号反相查文件

			find  /root  -perm  644 (按照权限查找）

			-iname			按照文件名查找，不区分大小写

			-mtime			修改时间  天		+10	-10	10

			在查找出的结果中，直接进行命令操作
			find  /var/log/  -mtime  +10  -exec  rm -rf  {} \;

			find /root -inum  1140247  -exec  ls -l {} \;

			find /root -size +5k  -a -size 6k


		4	grep	“字符串”  文件名		查找符合条件的字串行。		在文件当中查找符合条件的字符串
			命令名称：grep
			命令所在路径：/bin/grep
			执行权限：所有用户

			grep  -i  “root”  /etc/passwd
				-v		反向选择
				-i 		忽略大小写

		补充：
			| 管道符

			命令1  |  命令2
			
			ls | grep aa
			ls  -l  /etc  |  more
			netstat -tlun | grep 80

		补充命令：
			netstat  		查看网络状态的命令
				-t	查看tcp端口
				-u	查看udp端口
				-l	监听
				-n	以IP和端口号显示，不用域名和服务名显示

		

	二	压缩和解压缩
		
			。gz		。bz2		linux可以识别的常见压缩格式	
			.tar.gz	.tar.bz2	常见的压缩和打包命令


			压缩同时打包
				tar  -zcvf  压缩文件名  源文件
				tar  -zcvf  aa.tar.gz  aa
					-z  识别.gz格式
					-c	压缩
					-v	显示压缩过程
					-f	指定压缩之后的文件名

				tar  -zxvf  压缩文件名  -C  目录		解压缩同时解打包
					-C（大）  指定解压目录

			
				tar  -jcvf  压缩文件名  源文件	压缩同时打包
				tar  -jcvf  aa.tar.bz2  aa

				tar  -jxvf  aa.tar.bz2		解打包同时解压缩

			查看不解包
				tar  -ztvf  aa.tar.gz		查看不解包
				tar  -jtvf  aa.tar.bz2
					-t  只查看，不解压

	三	关闭和重启命令

			sync		同步命令
		
			1）shutdown  -h  now			没有特殊情况，使用此命令
				-h	关机
				-r	重启

	
					命令名称：shutdown
					命令所在路径：/sbin/shutdown
					执行权限：root	
			2）reboot
				命令名称：reboot
				命令所在路径：/sbin/reboot
				执行权限：root
			
	四	挂载命令
		
		linux所有存储设备都必须挂载使用，包括硬盘
			命令名称：mount
			命令所在路径：/bin/mount
			执行权限：所有用户

			光盘挂载

			/dev/sda1	第一个scsi硬盘的第一分区
			/dev/cdrom	光盘
			/dev/hdc	光盘

			常见文件系统：
				ext3		ext4
				fat16		fat32		ntfs
		
			mount  -t  文件系统  设备描述文件  挂载点（已经存在空目录）
			mount  -t  iso9660  /dev/cdrom  /mnt/cdrom

			光盘卸载
			umount  /dev/cdrom 
			umount  /mnt/cdrom 		强调：退出挂载目录，才能卸载


	五	网络命令
		1	ping	测试网络连通性
				命令名称：ping
				命令所在路径：/bin/ping
				执行权限：所有用户

			ping  -c  次数  ip		探测网络通畅

			ping  -s  65536  ip		指定探测数据包的大小		死亡之ping		DDOS：分布式拒绝服务攻击
			
			虚拟机不同：
				确定IP地址
				防火墙
				确定虚拟机网卡连接方式

		2	ifconfig  		查询本机网络信息
				命令名称：ifconfig
				命令英文原意：interface configure
				命令所在路径：/sbin/ifconfig
				执行权限：root


			ifconfig  eth0  192.168.140.252	netmask  255.255.255.0		临时生效

Linux特点：
	Linux中所有内容都是文件，包括硬件
	Linux严格区分大小写
	Linux不以扩展名区分文件类型。但是压缩包和rpm包例外
	Linux下所有存储设备都要挂载之后使用，包括硬盘，关盘，u盘










复习：
	目录相关命令
		ls查看	cd打开目录 	pwd查看当前目录名称	mkdir新建目录 	rmdir	tree
	文件相关命令
		touch新建文件	cat查看文件内容	more分页显示文件内容	head查看文件的头n行	tail  -f监听文件	ln  -s  源文件   目标文件
	文件和目录都相关
		mv剪贴文件	rm删除文件或目录	cp复制文件或目录
	权限命令
		chmod  755  文件名		chmod  u+x,g+w,o-w  aa	chmod  u=rwx  aa
		chown  用户名  文件名
		chgrp  组名  文件名
		chown  用户：组名  文件名

	帮助命令
		man  命令名

		命令 --help		-h

	搜索命令
		whereis	which
		find

	date	-s修改时间
	useradd 添加用户
	passwd 用户密码
	setup 
	service  network  restart


	10个权限
 	-普通文件
	d目录文件
	-l链接文件
	10个权限

	-------------
	第一个文件类型
	后面每三个一个组，
	第一个组:所有者U(USER)（读写可执行）RWX
	第二组：所有组G(GROUP)（读写可执行）
	第三组：其他人权限 0(OTHER)（读写可执行）

	数字方式
	1 执行
	2 写
	4 读

	一般所有者权限高于所有组高于其他组时


	对文件的权限，读可以产看文件内容  （不可以删除） CAT
	对文件的权限写，可以修改文件内容 （不可以删除）（需要上一级目录可以写） >>>插入数据
	对文件执行文件，文件可以执行  （ 不可以删除）

	对目录读，可以产看文件 ls
	对目录写权限： 创建，删除，目录
	对目录可执行目录 可以打开目录 CD



	通配符一般用于匹配文件名，正则匹配文件内容。


```







	











