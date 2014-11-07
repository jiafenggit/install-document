#nginx隐藏版本号
<pre>
http {  

server_tokens off;  #隐藏版本号  

}  

</pre>
#nginx 重载配置
<Pre>

nginx -s reload

</pre>
#php隐藏版本号
<pre>
将expose_php = On改为expose_php = Off  
</pre>
#apache 隐藏版本号
<Pre>
ServerSignature Off  
ServerTokens Prod  
</pre>



