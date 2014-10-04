```
netstat  -tlun



进程、服务管理和系统定时任务：
	
	一	进程查看		

		1	ps  aux		查看当前系统所有运行的进程
			-a 	显示前台所有进程
			-u	显示用户名
			-x	显示后台进程

			user： 用户名
			pid：	进程id。PID		1  init  系统启动的第一个进程
			%CPU	cpu占用百分比
			%MEM	内存占用百分比
			VSZ	虚拟内存占用量		KB
			RSS	固定内存占有量
			tty	登录终端		tty1-6		pts/0-pts/5
			stat	状态	S：睡眠		D：不可唤醒	R：运行	  T：停止  Z：僵死  W：进入内存交换	X：死掉的进程
					<:高优先级	N：低优先级	L：被锁进内存		s：含子进程	+：位于后台	l：多线程
			start	进程触发时间
			time	占用cpu时间
			command	进程本身


		2	top		动态查看进程			查看系统健康状态
				M	内存排比
				P	cpu排比
				q	退出
				u	只显示某用户进程
				k	杀死某进程
				q	退出
				h	帮助


			第一行：	当前时间   开机多久	登录用户数	1,5,15分钟平均负载
			第二行：	进程总数	运行	睡眠	停止	僵死
			第三行：	cpu占用百分比	 用户占用	内核占比	改过优先级的进程占比	id：空闲占比
			第四行		内存总数	占用	空闲	缓存
			第五行		swap总数

		3	pstree		显示进程树

		
		4	进程管理		终止进程
			kill  信号  PID		结束单个进程
			-9  强制

			killall  -9  进程名		结束一类进程
			pkill  -9  进程名
			pkill -9 httpd

			pkill  -9  -t  终端号	把某个终端登录的用户踢出
			pkill  -9  -t tty1		把本地登录终端1登录用户踢出


	二	工作管理		
		
		1	后台执行命令

			注意：放入后台的命令，必须可以持续一段运行时间，才能被操作
				放入后台的命令，必须不能和前台有交互，否则不能在后台恢复运行

			ctrl+z		正在运行的命令放入后台，后台状态是暂停
			命令 &		命令启动时就放入后台，后台状态是运行

		2	jobs		查询系统中后台工作


		3	fg	把后台工作恢复到前台运行
			fg  %工作号
			不加工作号，依据放入后台的顺序，倒序恢复

		4	bg	把后台工作恢复到后台运行（此命令必须和前台没有交互）
			bg  %工作号		

	三	linux服务管理
		
		1	分类
			1）系统默认安装的服务		rpm包
				①独立的服务
				②基于xinetd的服务，xinetd是系统超级守护进程
		
			2）源码包安装的服务

		（一）系统默认安装的服务
		1	确定服务分类
			chkconfig  --list		查看服务的自启动状态
				运行级别：0-6
					0	关机
					1	单用户模式
					2	不完全多用户，不包含NFS服务
					3	完全多用户	字符界面
					4	未分配
					5	图形界面
					6	重启

					runlevel	查询系统运行级别
					init  级别号	切换运行级别
					init  0	关机		init 5  startx 	init 3
					init  6	重启

					vi  /etc/inittab		init配置文件
					 id:3:initdefault:		开机默认运行

		2	独立的服务器管理		

			1）启动			
				①
				/etc/rc.d/init.d/服务名   start|stop|restart|status
				/etc/rc.d/init.d/httpd  start

				②
				service   服务名   start|stop|restart|status

			2)自启动		
				①
				chkconfig  --level  2345  服务名  on|off

				②
				vi  /etc/rc.local---->/etc/rc.d/rc.local
				/etc/rc.d/init.d/httpd  start

				

		
		3	ntsysv
			所有系统默认安装服务都可以使用ntsysv命令进行自启动管理

		（二）源码包安装的服务
			1源码包安装的服务			

			1）绝对路径启动
			/usr/local/apache2/bin/apachectl  start

			2)自启动
			vi /etc/rc.local
			/usr/local/apache2/bin/apachectl  start

	四	计划任务

			echo  11  >>  /root/aa		在aa文件中追加11.一会定时任务验证用


			循环定时任务						
			crontab  -e		编辑定时任务
			* * * * *  命令
			10  *  31  *  *  命令
			10  *  *  *  *  命令
			5  4  *  5-10  *  命令
			*/10  *  *  *  *  命令
			5 4  1,15  *  5  命令		日期和星期不要同时指定，会超出预期
			

			第一个*：一小时中第几分钟		0-59
			第二个：一天中第几个小时		0-23
			第三个：一个月中第几天			1-31
			第四个：一年第几个月			1-12
			第五个：一周中星期几			0-6		注意：星期几何第几天不能同时出现


			crontab  -l		查看系统定时任务
			crontab  -r  		删除定时任务

	五	系统运行级别
		
		1	dmesg				查看系统启动信息

			/var/log/dmesg		系统启动信息日志
			
			dmesg | grep eth0		查看eth0信息
			dmesg | grep CPU		查看cpu信息

		2	系统运行级别
			0	关机
			1	单用户
			2	不完全多用户，不含NFS
			3	完全多用户
			4	保留
			5	图形界面
			6	重启

			runlevel  		查询系统运行级别

			init  运行级别		改变运行级别			init 0     init  6


			修改系统默认运行级别
			vi  /etc/inittab			init配置文件
			id:3:initdefault:			系统默认运行级别


	六	单用户模式

		破解用户密码
		重启---任意键----e---选择内核项---e----空格1----回车---b

		
		root密码---------grub加密-------BIOS加密------锁起来-------保安
		单用户破解	   光盘修复模式   拔电池	    螺丝刀	   电棍
















					


	
```