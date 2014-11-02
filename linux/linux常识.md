linux 支持ntfs文件系统

ntfs-3g-2011.4.12-5.el5.i386.rpm



rpm -ivh linuxqq-v1.0.2-beta1.i386.rpm


查看某一端口是否开放

netstat -nupl  (UDP类型的端口)
netstat -ntpl  (TCP类型的端口)

netstat -tln  查看开放的端口


查询端口属于那些程序
lsof -i ：7710　


修改系统时区
cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime  
hwclock




    date -s 2011-02-23 # 设置日期
    date -s 11:22;33 # 设置时间
    date -s "2011-02-23 11:22:33" # 设置日期和时间
    
    ntpdate -u 210.72.145.44  同步时间
    ntpdate -u ntp.api.bz
  
 定时任务
 
 
 基本格式 :
*　　*　　*　　*　　*　　command
分　时　日　月　周　命令
第1列表示分钟1～59 每分钟用*或者 */1表示
第2列表示小时1～23（0表示0点）
第3列表示日期1～31
第4列表示月份1～12
第5列标识号星期0～6（0表示星期天）
第6列要运行的命令   

crontab -uroot -e
    
    


