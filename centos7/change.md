#centos 7 搭建LAMP环境
>安装遵循需要什么安装什么
* 安装时选择最小化安装
* 设置英语 时区选择shanghai
* 硬盘分区并且启用lvm(逻辑卷管理)


##系统安装完成，下面是一些必要的配置
###第一步设置ip地址
设置ip
root 用户下
vi /etc/network-scripts/ifcfg-ens33
修改设置：
BOOTPROTO=STATIC
ONBOOT=YES
添加选项
IPADDR=192.168.0.133 (您的的ip)
NETMASK=255.255.255.0 (子网掩码)
GATEWAY=192.168.0.1 （网关）
DNS1 = 233.5.5.5    （dns）


###重启网络服务
service network restart 或者 systemctl restart network
查看 ip:  ip addr

##开始搭建LAMP
###换源：
cd /etc/yum.repos.d
备份当前目录下的CentOS-Base.repo
cp CentOS-Base.repo.backup
vi CentOS-Base.repo  
修改里面的 mirrorlist.centos.org 换为制定的源比如http://mirrors.yun-idc.com/  
或者下载源文件文件，前提必选先安装weget，最小化情况下wget未安装
wget -O CentOS-Base.repo http://mirrors.aliyuncs.com/repo/Centos-7.repo

###准备需要的包
安装gcc