#Ssh 证书登录linux服务器   
##1、Linux下生成密钥 
 登录需要使用证书登录的账户后运行： # ssh-keygen -t rsa 
 Generating public/private rsa key pair.  Enter file in which to save the key (/root/.ssh/id_rsa): 此步骤指定密钥存放路 径，直接回车，  按照提示设置口令之后，即在/root/.ssh/中生成公钥和私钥：id_rsa id_rsa.pub 
 
##2、把公钥信息写入authorized_keys文档中  # cd ~/.ssh   （进入密钥存放目录） 
 # cat id_rsa.pub >> authorized_keys（将生成的公钥文件写入authorized_keys文件）
 #chmod 400 authorized_keys (将authorized_keys文件的权限设置为400)  

##3、把id_rsa文件拷贝到客户端    将id_rsa文件拷贝到需要登录服务器的客户端，请妥善保存。  为了安全可以把服务器上的id_rsa和id_rsa.pub删除。  

##4、配置/etc/ssh/sshd_config  
  Protocol 2 (仅使用SSH2) 
  PermitRootLogin no (不允许root用户使用SSH登陆，根据登录账户设置) 
  #ServerKeyBits 1024 (将serverkey的强度改为1024) 这里不用改默认是2048
  PasswordAuthentication no (不允许使用密码方式登陆) 
  PermitEmptyPasswords no   (禁止空密码进行登陆) 
  RSAAuthentication yes  （启用 RSA 认证）
  PubkeyAuthentication yes （启用公钥认证）
  AuthorizedKeysFile   .ssh/authorized_keys (~/.ssh/authorized_keys 表示每个用户对应的家目录下)
  StrictModes yes改成StrictModes no （如果StrictModes为yes必需保证存放公钥的 文件夹的拥有者与登陆用户名是相同的）   

##5、重启sshd   service sshd restart


配置已完成，下面是客户端配置



##6 SecureCRT 秘钥转换
秘钥转换：ssh-keygen -i -f Identity.pub >>authorized_keys     chmod 400 ./authorized_keys


##7 winscp 普通用户以root用户身份登录sftp

1.查看sftp-server执行文件目录：
	cat /etc/ssh/sshd_config|grep sftp
	Subsystem   sftp    /usr/libexec/openssh/sftp-server
2.编辑/etc/sudoers为特定用户添加执行sftp sudo权限：
   user ALL=NOPASSWD:  /usr/libexec/openssh/sftp-server （user修改为对应的用户名称）
3.需在/etc/sudoers内注释此行：
   #Defaults    requiretty   （此行加上注释）
   
4.winscp sftp 配置   找到选线设置为一下设置：
   sftp服务器 设置为  sudo /usr/libexec/openssh/sftp-server

