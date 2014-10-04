```



第四讲		vi编辑器		

	一 	vi编辑器简介
		vim		全屏幕纯文本编辑器

	二	vim使用
		1	vi模式 
			vi  文件名
			
			命令模式
			输入模式
			末行模式 shift : 进入末行模式

			命令----》输入  a：追加  i：插入  o：打开
			命令----》末行	  :	:w  保存     :q  不保存退出    :wq	保存退出	!  强制		:q!   :wq!
			输入----末行

		2	命令模式操作

			1）光标移动
			hjkl		

			:n		移动到第几行

			gg		移动文件头
			G		移动到文件尾

			3）删除字母
			x		删除单个字母
			nx		删除n个字母

			4）删除整行	剪切
			dd		删除单行
			ndd		删除多行
			p		粘贴
			P（大）		粘贴到光标前

			dG		从光标所在行删除到文件尾

			5）复制
			yy	
			nyy

			6）撤销
			u		撤销
			ctrl+r		反撤销

			7)显示行号
			:set  nu	
			:set  nonu	

			8)颜色开关
			:syntax  off
			:syntax  on

vi配置文件
~/.vimrc	手工建立的，vi配置文件

			9)查找			掌握
			/查找内容		向下查找
			
			n	下一个
			N	上一个

			10）替换		
			：1,10s/old/new/g		替换1到10行的所有old为new
			：%s/old/new/g		替换整个文件的old为new
						g	范围内所有old换为new

			：1,5s/^/#/g			注释1到5行
			:1,5s/^#//g			取消注释

			:1,5s/^/\/\//g		文件头加入//



软件包安装				

	一 	软件包分类

		源码包	：	特点	开源	自由定制
				缺点：	编译时间长，一旦报错，很难解决
		
			脚本安装包：

		二进制包：rpm包
				特点：安装速度快	简易
				缺点：自定义性差	依赖性

				a---->b---->c		树形依赖
				a---b----c---a	环形依赖
				库文件依赖		www.rpmfind.net
				(rpm -ivh /mnt/CentOS/mysql-connector-odbc-3.51.26r1127-1.el5.i386.rpm )

				 libodbcinst.so.1

	二	rpm安装

		1	包命名
			包名-版本号-发布次数-硬件平台.rpm

		2	依赖性

		3	安装

			
			rpm  -ivh  包全名（绝对路径）
				-i  安装	-v	显示详细信息		-h 显示进度

			rpm  -Uvh  包全名
				-U  升级

		4	卸载
			rpm  -e  包名
				--nodeps	不检查依赖性

		5	查询
			rpm  -q  包名		查询包是否安装
			rpm  -qa  | grep  httpd 		显示所有安装包
			
			rpm  -qi  包名	查询包的信息		-p  未安装包
			rpm  -qip  包全名	查询没有安装包的信息


			rpm  -ql  包名	查询包中文件的安装位置
			rpm  -qlp  包全名	查询没有安装的包，打算安装位置

			rpm  -qf  系统文件名		查询系统文件属于哪个包

	
		（7）	启动httpd服务
			service  httpd  restart|start|stop|status
			/etc/rc.d/init.d/httpd  start

	二	yum

		yum  -y  install  包名		安装			-y  自动回答yes
		yum  -y  remove  包名		当它不存在
		yum  -y  update  包名
		yum  list			查询所有可以安装的包

		光盘作为yum源：
			1	cd  /etc/yum.repos.d/
				mv  CentOS-Base.repo  CentOS-BS.repo.bak

			2	mount /dev/hdc  /mnt/cdrom

			3	vi  /etc/yum.repos.d/CentOS-Media.repo
				baseurl=file:///mnt/cdrom/			指定yum源位置
				enabled=1					yum源文件生效
				gpgcheck=0					rpm验证不生效

		pkill -9 yum-updatesd		如果yum报错正在升级，执行此命令，强制杀死升级进程

		yum  -y  install  gcc 		(gcc是c语言编译器，不装gcc，源码包不能安装)


	三	源码包安装

		1	远程传输工具winscp传输apache到linux。
				httpd

		2	安装
			1）解压

			2） cd  解压目录
			
			3）  查看安装文档

				INSTALL		README

			4）编译前准备
			./configure  --prefix=/usr/local/apache2

			5)编译			make  clean			make  clear
			make

			6）编译安装
			make  install

				注意error  warning等错误报警
		
		3	启动
			/usr/local/apache2/bin/apachectl  start

		4	删除
			直接删除安装目录



		
			














































```