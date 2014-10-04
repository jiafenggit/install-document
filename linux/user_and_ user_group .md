
```


第五讲:		用户和用户组管理

		一	用户相关文件			掌握						

			1	/etc/passwd		用户信息文件

			root:x:0:0:root:/root:/bin/bash
		
			第一列：用户名
			第二列：密码位
			第三列：用户ID  UID	0：超级用户	1-499：系统用户(伪用户)	
			第四列：组ID	GID	添加用户时，如果不指定用户所属的初始组，那么会建立和用户名相同的组
			第五列：用户说明
			第六列：用户家目录	~
			第七列：登录shell	/bin/bash	

			如何把普通用户变成超级户：把用户UID改为0	

			2	/etc/shadow		影子文件
				400
			第一列：	用户名	
			第二列：	加密密码
			第三列：	密码最近更改时间
			第四列：	两次密码修改间隔时间
			第五例：	密码有效期
			第六列：	警告天数
			第七列：	密码过期后宽限天数
			第八列：	密码失效时间
			第九列：	保留

			3	/etc/group		组信息文件
				root:x:0:root

				第一列：	组名
				第二列：	组密码位
				第三列：	GID
				第四列：	此组中支持的其他用户.附加组是此组的用户

				vi 初始组：每个用户初始组只能有一个，初始组只能有一个，一般都是和用户名相同的组作为初始组
				附加组：每个用户可以属于多个附加组。要把用户加入组，都是加入附加组

			4	/home/用户名		每个用户的家目录


	二	用户管理命令				

		1	添加
			useradd  用户名		

			useradd  选项  用户名
			选项：
				-g  组名	指定初始组	不要手工指定	
				-G  组名	指定附加组，把用户加入组，使用附加组
				-c  说明	添加说明
				-d  目录	手工指定家目录，目录不需要事先建立
				-s  shell	/bin/bash	
--
			useradd -d /cc  cc		如果修改家目录，不需要手工建
			useradd  -G  user1  aa	添加用户aa，指定附加组为user1

		2	设定密码			
			passwd	  用户名
			passwd			改变root密码
			passwd  root		改变root密码

		3	用户信息修改		修改已经存在的用户信息					
			usermod  -L(大)  用户名		锁定用户
			usermod  -U(大)  用户名		解锁

			usermod  -l  新名  旧名		用户改名

		4	删除用户				
			userdel  -r  用户名
				-r  连带家目录一起删除
vi 
		5	添加组				
			groupadd  组名

		6	删除组				
			groupdel  组名		注意：必须是空组


		7	把已经存在的用户加入组					


	
			gpasswd  -a  用户名  组名		用户加入组
			gpasswd  -d  用户名  组名		把用户从组中删除

	三	用户相关命令				
		1	id  用户名		显示用户的UID，初始组，和附加组

		2	su  -  用户名		切换用户身份			
				-	连带环境变量一起切换		


	四	ACL权限				

		1	getfacl  文件名		查询文件的acl权限

		2	setfacl  选项  文件名		设定acl权限
				-m			设定权限
				-b			删除权限

			setfacl  -m  u:用户名:权限   文件名
			setfacl  -m  g:组名：权限   文件名

			setfacl  -m u:aa:rwx  /test		给test目录赋予aa是读写执行的acl权限

			setfacl -m u:cc:rx -R soft/		赋予递归acl权限，只能赋予目录
				-R  递归	

			setfacl  -b  /test		删除acl权限

		3	setfacl  -m d:u:aa:rwx -R /test		acl默认权限。		注意：默认权限只能赋予目录
	
			注意：如果给目录赋予acl权限，两条命令都要输入
				-R 递归
				-m  u:用户名：权限		只对已经存在的文件生效
				-m  d:u:用户名：权限		只对未来要新建的文件生效

注意：	rwx权限，属主、属组、其他人身份、acl权限都是用户针对文件或目录的权限
	sudo权限，是用户针对自身所能够执行的命令的权限

	五	sudo授权		给普通用户赋予部分管理员权限				

			/sbin/			在此目录下命令只有超级用户才能使用
			/usr/sbin/

		1	root身份：

			visudo		赋予普通用户权限命令，命令执行后和vi一样使用
	
			root    ALL=(ALL)       ALL
			root：	用户名
			ALL：	来源主机
			（ALL）：	切换成什么身份
			ALL：		可用命令

			aa  ALL=/usr/sbin/useradd  		赋予aa添加用户权限.命令必须写入绝对路径

			aa  ALL=/usr/bin/passwd		赋予改密码权限，取消对root的密码修改
			aa  ALL=/usr/bin/passwd [A-Za-z]*,  !/usr/bin/passwd "",  !/usr/bin/passwd root

			aa1

		2	aa身份
		
			sudo  -l	查看可用sudo权限

			sudo  /usr/sbin/useradd  ee		普通用户使用sudo命令执行超级用户命令

	六	输出重定向和多命令顺序执行

		1	输出重定向
				把应该输出到屏幕的输出，重定向到文件。

				>	覆盖
				>>	追加

			ls  >  aa		覆盖到aa
			ls  >>  aa		追加到aa

			ls  gdlslga  2>>aa		错误信息输出到aa		强调：错误输出，不能有空格


			掌握
			ls  >>  aa  2>&1		错误和正确都输入到aa，可以追加
							2>&1	把标准错误重定向到标准正确输出

			ls  >>  aa  2>>bb		正确信息输入aa，错误信息输入bb


		2	管道符			
			命令1  |  命令2			命令1的执行结果，作为命令2的执行条件

			netstat -an | grep ESTABLISHED | wc -l		统计正在连接的网络连接数量

			more  文件名  |  grep  “字串”			提取含有字符串的行

			ls  |  more						分屏显示ls内容





























```