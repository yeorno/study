#amp安装教程
下载apache:https://www.apachehaus.com/
下载php:http://www.php.net/downloads.php
下载mysql:https://dev.mysql.com/downloads/mysql/
下载phpmyadmin:https://www.phpmyadmin.net/downloads/

apache2.4+mysql5.7+php7.2-ts
windows环境：
	进入到apache/bin
	安装：cmd进入到apache安装目录
			httpd.exe -k install 安装apache
			httpd.exe -k stop 停止apache
			httpd.exe -k start 启动apache
			httpd.exe -k restart 重启apache
	apache配置文件：apache/conf/http.conf

		Define SRVROOT "C:\wamp\Apache24"#apache安装目录
		ServerRoot "${SRVROOT}"

		#php7 support
		LoadModule php7_module C:\wamp\php7\php7apache2_4.dll #路径保证正确
		AddType application/x-httpd-php .php .html .htm
		PHPIniDir "C:\wamp\php7" #php7安装目录
		Action application/x-httpd-php "C:\wamp\php7\php-cgi.exe
	php7配置文件
		复制php.ini-production文件，修改文件名为php.ini
		打开php.ini 文件
		找到extension_dir,取消注释,php安装目录，一定不能错，否则不能开启任何的扩展
		extension_dir = "C:\wamp\php7\ext"
		之后可以开启各种扩展
	mysql配置
		

	     在mysql安装目录下,新建my.ini文件,写入以上基本信息


	        [mysql]  
      
		    # 设置mysql客户端默认字符集  
		      
		    default-character-set=utf8   
		      
		    [mysqld]  
		      
		    #设置3306端口  
		      
		    port = 3306   
		      
		    # 设置mysql的安装目录  
		      
		    basedir=C:\wamp\mysql
		      
		    # 设置mysql数据库的数据的存放目录  
		      
		    datadir=C:\wamp\mysql\data #data目录不用手动新建
		      
		    # 允许最大连接数  
		      
		    max_connections=200  
		      
		    # 服务端使用的字符集默认为8比特编码的latin1字符集  
		      
		    character-set-server=utf8  
		      
		    # 创建新表时将使用的默认存储引擎  
		      
		    default-storage-engine=INNODB  

		    #skip-grant-tables

		  安装mysql:
		 cmd进入到mysql安装目录：mysql/bin
		 mysqld install 安装
		 mysqld --initialize #初始化设置，会生成root用户

		 net mysql start #启动mysql

		 tips:mysql5.7之后，root用户会生成默认随机密码
		 解决方案：编辑my.ini文件， #skip-grant-tables取消此行注释，重启mysql
		 此行意思是：密码不为空，就能登陆进去
		 执行mysql：update user set authentication_string=password('123456') where User='root';
		 退出重启mysql，


		
		
		安装完毕之后，会出现1820错误，解决方案：
		执行：set passowrd=password('密码'); #设置新密码

		执行:flush privileges	#刷新权限	

		安装phpmyadmin:
		编辑配置文件：E:\wamp\pms\libraries\config.default.php

		$cfg['PmaAbsoluteUri'] = 'E:\wamp\phpmyadmin';#phpmyadmin的安装目录
		$cfg['blowfish_secret'] = 'fsdkfhsdjksgdkhfgdshfushfsdjvfdfjsdkjh';#这里想写什么就写什么
		$cfg['Servers'][$i]['user'] = 'root';#登陆账号
		$cfg['Servers'][$i]['password'] = '123456';#登陆密码




