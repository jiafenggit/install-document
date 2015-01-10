###linux 禁止root登陆
新建用户

userad xieyaokun


password 123456789


passwd修改密码


不允许用户登录

vi /etc/ssh/sshd_config

#PermitRootLogin YES


su  切换用户 





