主从配置
	windows修改mysql.ini
	linux修改/etc/mysql/mysql.conf.d/mysqld.cnf
	主服务器配置：

		server-id=456#自定义唯一
		log-bin=mysql-bin#启用二进制日志
		binlog-do-db=test# 需要同步的数据库
		binlog-ignore-db=mysql#忽略的数据表
		执行show master status；
		查看信息
	从服务器配置
	server-id=789#自定义唯一
	replicate-do-db=test# 需要同步的数据库
	binlog-ignore-db=mysql#忽略的数据表
	修改mysql配置文件之后，重启mysql
	重启mysql之后，执行3个sql语句;
	1.stop slave;
	2.change master to 
		master_host='192.168.182.128',#需要同步服务器的ip
		master_user='slave',#mysql登陆账号
		master_password='123456',#mysql登陆密码
		master_log_file='mysql-bin.000001',#值需要和show master status 状态的值一致
		master_log_pos=791;#值需要和show master status 状态的值一致
		#这一步执行成功之后，用slave账号登陆主数据库的，检测是否登陆成功
	3.start slave

	#到了这里基本成功,
	查看从数据库是否配置成功：
	show slave status\G;
		Slave_IO_Running:yes
		Slave_SQL_Running:yes
	只有这两个值为yes,才配置成功。	

	注意细节：
		1.需要同步的表为test,在主从配置成功之后，再创建test表.否则从数据库会报错。报错之后，再执行上面1,.2.3个步骤，即可解决
		2.在linux环境下.从数据库连接主数据库会失败。原因可能有3个:
			（1）修改配置文件，注释bind-addres=127.0.0.1
			 (2)修改mysql数据库user表，把user=root的用户修改host成%
			 （3）防火墙：ufw enadble 关闭防火墙即可。
			 （4）（1）和（2）一般情况下需要同时修改
			 （5）不能再从数据库执行任何操作。负责从数据库会报错。如果已经在从数据库有了操作，执行重启mysql之后，执行3个sql语句即可;

