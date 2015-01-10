<VirtualHost *:80>
ProxyPreserveHost On
ServerName www.example.com
ProxyPass / http://www.example.com:8000/
ProxyPassReverse / http://www.example.com:8000/
ServerAdmin webmaster@localhost
</VirtualHost>

<VirtualHost *:80>
ProxyPreserveHost On
ServerName www.yuelu.net
ProxyPass / http://www.example.com:8000/
ProxyPassReverse / http://www.example.com:8000/
ServerAdmin webmaster@localhost
</VirtualHost>

<VirtualHost *:80>
ProxyPreserveHost On
ServerName www.yuelu.net
ProxyPass / http://manage.example.com:8000/
ProxyPassReverse / http://www.example.com:8000/
ServerAdmin webmaster@localhost
</VirtualHost>