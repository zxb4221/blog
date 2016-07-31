-- phpMyAdmin SQL Dump
-- version 4.0.10.11
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016-07-29 20:55:08
-- 服务器版本: 5.5.46
-- PHP 版本: 5.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `a0724115905`
--

-- --------------------------------------------------------

--
-- 表的结构 `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `author` varchar(50) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  `publishdate` datetime DEFAULT NULL,
  `modifydate` datetime DEFAULT NULL,
  `read_count` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `blog`
--

INSERT INTO `blog` (`id`, `title`, `content`, `author`, `type_id`, `publishdate`, `modifydate`, `read_count`) VALUES
(5, 'linux(ubuntu 16.04) 安装 zsh,oh-my-zsh', '<p>\r\n	<strong>如果没有安装git需要先安装git:</strong><br />\r\n1. sudo apt-get install git&nbsp;\r\n</p>\r\n<p>\r\n	2. sudo apt-get install zsh&nbsp;\r\n</p>\r\n<p>\r\n	3. wget --no-check-certificate http://install.ohmyz.sh -O - | sh&nbsp;\r\n</p>\r\n<p>\r\n	4. 这时可能会出现 密码： chsh：PAM, 手动输入 chsh -s /bin/zsh 即可解决&nbsp;\r\n</p>\r\n<p>\r\n	5. 注销或重启就ok了\r\n</p>\r\n<p>\r\n	<br />\r\n<strong>oh-my-zsh 安装主题</strong><br />\r\ngedit ~/.zshrc<br />\r\nZSH_THEME="robbyrussell"\r\n</p>\r\n<p>\r\n	<br />\r\n<strong>安装autojump</strong><br />\r\nsudo apt-get install autojump<br />\r\ngit clone https://github.com/joelthelion/autojump.git<br />\r\n进入autojump 的目录，cd autojump，执行<br />\r\npython ./install.py\r\n</p>\r\n<p>\r\n	<br />\r\n<strong>最后其会有提示</strong><br />\r\nvim ～/.zshrc 添加如下到 ~/.zshrc<br />\r\n[[ -s /home/tan/.autojump/etc/profile.d/autojump.sh ]] &amp;&amp; source /home/tan/.autojump/etc/profile.d/autojump.sh<br />\r\nautoload -U compinit &amp;&amp; compinit -u\r\n</p>', 'zxb', NULL, '2016-07-24 16:37:45', '2016-07-24 16:45:22', 11),
(6, 'ubuntu 16.04 安装 Apache OpenOffice', '<p>\r\n	<span style="font-size:14px;">环境：ubuntu 14.04 64bit</span>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//清除libreoffice，与openoffice有冲突</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">sudo apt-get remove --purge libreoffice*</span><br />\r\n<span style="font-size:14px;"> sudo apt-get clean</span><br />\r\n<span style="font-size:14px;"> sudo apt-get autoremove</span>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//下载openoffice</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">wget&nbsp;</span><a href="http://sourceforge.net/projects/openofficeorg.mirror/files/4.1.1/binaries/zh-CN/Apache_OpenOffice_4.1.1_Linux_x86_install-deb_zh-CN.tar.gz"><span style="font-size:14px;">http://sourceforge.net/projects/openofficeorg.mirror/files/4.1.1/binaries/zh-CN/Apache_OpenOffice_4.1.1_Linux_x86_install-deb_zh-CN.tar.gz</span></a>\r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//安装</span>\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">tar -xzvf Apache_OpenOffice_4.1.1_Linux_x86_install-deb_zh-CN.tar.gz</span><br />\r\n<span style="font-size:14px;"> cd zh-CN/DEBS</span><br />\r\n<span style="font-size:14px;"> sudo dpkg -i *.deb</span><br />\r\n<span style="font-size:14px;"> cd desktop-integration</span><br />\r\n<span style="font-size:14px;"> sudo dpkg -i *.deb</span>\r\n</p>', 'zxb', NULL, '2016-07-24 17:46:26', '2016-07-24 17:46:26', 16),
(12, 'SQL外键约束，级联更新、级联删除', '<p>\r\n	<span style="font-size:14px;">用一个实例来说明SQL外键约束，级联更新与级联删除。</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">定义两张表，表1为文章表article，记录文章信息，表2为文章评论表comment，记录文章的评论信息。</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//创建文章信息表article</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">create table article(id int not null, title varchar(255), content text, primary key(id));</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//创建评论信息表comment</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">create table comment(id int not null, content text, article_id int, foreign key(article_id) references article(id) on&nbsp;&nbsp;update cascade on&nbsp;delete&nbsp;cascade);</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//向article插入一条记录</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">insert into article values(1,''title'',''content'');</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//向comment插入一条记录。</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">insert into comment values(1,''comment_text'',999);&nbsp;&nbsp;&nbsp;&nbsp;//article_id设置为999,插入失败</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">insert into comment values(1,''comment_text'',1);&nbsp;&nbsp;&nbsp;&nbsp;//article_id设置为1,插入成功</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//删除article表记录，则comment中article_id为1的记录也会被删除</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">delete from article where id=1;</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">//更新article表id值，comment表中关联的arctile_id为1的也会自动更新为2</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">update article set id=2 where id =1;</span> \r\n</p>\r\n<p>\r\n	<br />\r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">若想要限制级联更新与删除，将cascade关键字换成restrict，如下：</span> \r\n</p>\r\n<p>\r\n	<span style="font-size:14px;">create table comment(id int not null, content text, article_id int, foreign key(article_id) references article(id) on &nbsp;update&nbsp;restrict&nbsp;on&nbsp;delete&nbsp;restrict);</span> \r\n</p>\r\n<div>\r\n	<br />\r\n</div>', 'zxb', NULL, '2016-07-25 01:02:55', '2016-07-25 01:02:55', 14),
(13, 'MySQL 多个配置文件my.cnf所在路径及其优先级分析', '<p style="font-family:Arial;font-size:15px;">\r\n	测试环境：Ubuntu 16.04 64bit，MySQL 5.7.13\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	my.cnf文件是MySQL在unix平台下的默认配置文件，通常默认路径为/etc/my.cnf\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	MySQL服务在启动过程中，会去多个位置寻找my.cnf，通过如下方法可以获得MySQL默认配置文件my.cnf的存在位置。\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	输入命令：my_print_defaults，获得以下输出信息\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	Default options are read from the following files in the given order:\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	/etc/my.cnf /etc/mysql/my.cnf ~/.my.cnf\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	也就是说，MySQL服务启动时，先读/etc/my.cnf，再去读/etc/mysql/my.cnf，最后读~/.my.cnf。\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	通常/etc/my.cnf /etc/mysql/my.cnf ~/.my.cnf 是MySQL最常用的三个配置文件路径。<span style="line-height:1.6;">其中/etc/my.cnf与/etc/mysql/my.cnf为全局选项文件，</span>而~/.my.cnf为用户选项文件。\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	如果三个文件同时存在，并且拥有重复的且值不同的选项，那么选项的优先级如何确定？\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	下面通过实验来验证，准备三个配置文件，如下：\r\n</p>\r\n<p style="font-family:Arial;">\r\n	<span style="font-size:14px;">/etc/my.cnf</span><br />\r\n	<p style="font-size:15px;">\r\n		<span style="font-size:14px;">[mysqld]<br />\r\n</span><span style="font-size:14px;">long_query_time = 1</span>\r\n	</p>\r\n	<p>\r\n		<span style="font-size:14px;line-height:21px;"><br />\r\n</span>\r\n	</p>\r\n	<p>\r\n		<span style="font-size:14px;line-height:21px;"><span style="font-family:Arial;font-size:14px;line-height:21px;">/etc/mysql/my.cnf</span><br />\r\n</span><span style="font-size:14px;">[mysqld]</span><br />\r\n<span style="font-size:14px;">long_query_time = 2</span>\r\n	</p>\r\n	<p>\r\n		<span style="font-size:14px;line-height:21px;"><br />\r\n</span>\r\n	</p>\r\n	<p>\r\n		<span style="font-size:14px;line-height:21px;"><span style="font-family:Arial;font-size:14px;line-height:21px;">~/.my.cnf</span><br />\r\n</span><span style="font-size:14px;">[mysqld]</span><br />\r\n<span style="font-size:14px;">long_query_time = 3</span>\r\n	</p>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-size:14px;"></span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-size:14px;line-height:22px;">启动MySQL服务，查询</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-size:14px;line-height:1.6;">mysql&gt;&nbsp;show&nbsp;variables&nbsp;like&nbsp;''long_query_time‘</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<ol>\r\n		<li>\r\n			<span style="line-height:1.5;">当只有一个/etc/my.cnf文件时，查询结果为1.000000</span>\r\n		</li>\r\n		<li>\r\n			<span style="line-height:1.5;">同时存在/etc/my.cnf, /etc/mysql/my.cnf时，查询结果为2.000000</span>\r\n		</li>\r\n		<li>\r\n			<span style="line-height:1.5;">同时存在/etc/my.cnf, ~/.my.cnf时，查询结果为3.000000</span>\r\n		</li>\r\n		<li>\r\n			<span style="line-height:1.5;">同时存在/etc/mysql/my.cnf, ~/.my.cnf时，查询结果为3.000000</span>\r\n		</li>\r\n		<li>\r\n			<span style="line-height:1.5;">三个同时存在时，查询结果为3.000000</span>\r\n		</li>\r\n	</ol>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	以上结果说明了~/.my.cnf优先级最高，然后是/etc/mysql/my.cnf，最后是/etc/my.cnf，用户选项文件（~/.my.cnf）高于全局选项文件（/etc/my.cnf, /etc/mysql/my.cnf)。建议在使用时，只使用一个配置文件，比如 /etc/my.cnf，降低复杂性，减少出错可能。\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-size:14px;line-height:1.6;">''</span>\r\n</p>\r\n<div>\r\n	<br />\r\n</div>', 'zxb', NULL, '2016-07-28 00:03:06', '2016-07-28 00:03:06', 16),
(14, 'mysqldump数据库备份工具的使用方法', '<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">mysqldump是MySQL数据库附带的一个数据库备份程序，</span><span style="line-height:1.6;font-family:SimSun;">mysqldump可以针对单个表、多个表、单个数据库、多个数据库、所有数据库进行导出的操作。</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;"><span style="font-family:SimSun;"></span><br />\r\n</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">shell&gt; mysqldump [options] db_name [tbl_name ...] //导出指定数据库或单个表</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">shell&gt; mysqldump [options] --databases db_name ... //导出多个数据库</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">shell&gt; mysqldump [options] --all-databases //导出所有数据库</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;"></span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<strong><span style="font-family:SimSun;">1.mysqldump的几种使用场景：</span></strong> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（1）导出全部数据库（包含所有数据库中的数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp;&nbsp;&nbsp;&nbsp;mysqldump -uusername -p -A &gt; all_db.sql</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（2）导出全部数据库结构（不包含所有数据库中的数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp;&nbsp;&nbsp;&nbsp;mysqldump -uusername -p -A -d&gt; all_db_struct.sql</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（3）导出某个数据库(包含该数据库中的数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp; &nbsp;&nbsp;mysqldump -uusername -p dbname &gt; dbname.sql &nbsp; &nbsp;</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（4）导出某个数据库结构(包含该数据库中的数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp; &nbsp;&nbsp;mysqldump -uusername -p -d dbname &gt; dbname_struct.sql &nbsp; &nbsp;</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">&nbsp;</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（5）导出数据库中的某张数据表（包含数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">&nbsp;&nbsp;&nbsp;&nbsp;mysqldump -u username -p dbname tablename &gt; tablename.sql &nbsp; &nbsp;</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">（6）导出数据库中的某张数据表的表结构（不含数据）</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp; &nbsp; mysqldump -u username -p -d dbname tablename &gt; tablename_struct.sql</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">&nbsp;&nbsp;&nbsp;</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<strong><span style="font-family:SimSun;">2.mysqldump常用参数说明：</span></strong> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--</span><span style="line-height:1.6;font-family:SimSun;">user, -u指定连接的用户名；</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--password, -p连接数据库密码；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--port, -P连接数据库端口号；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--all-databases , -A&nbsp;导出全部数据库;</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--no-data, -d不导出任何数据，只导出数据库表结构；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--databases, -B导出几个数据库。参数后面所有名字参量都被看作数据库名；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">--ignore-table，不导出指定表。指定忽略多个表时，需要重复多次，每次一个表。每个表必须同时指定数据库和表名。例如：</span><span style="line-height:1.6;font-family:SimSun;">mysqldump -uroot -p --all-databases --ignore-table=database.table1 --ignore-table=database.table2</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--no-create-db, -n只导出数据，而不添加CREATE DATABASE 语句；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--no-create-info, -t只导出数据，而不添加CREATE TABLE 语句；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--default-character-set，设置默认字符集，默认值为utf8</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">--</span><span style="line-height:1.6;font-family:SimSun;">all-tablespaces , -Y导出全部表空间;</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--all-tablespaces–no-tablespaces , -y不导出任何表空间信息；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--add-drop-database，每个数据库创建之前添加drop数据库语句；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--add-drop-table，每个数据表创建之前添加drop数据表语句，默认为打开状态，使用--skip-add-drop-table取消选项；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--add-locks，在每个表导出之前增加LOCK TABLES并且之后UNLOCK TABLE，默认为打开状态，使用--skip-add-locks取消选项；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--comments，附加注释信息，默认为打开，可以用--skip-comments取消；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--compact，导出更少的输出信息(用于调试)。去掉注释和头尾等结构；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--complete-insert, -c使用完整的insert语句(包含列名称)。这么做能提高插入效率，但是可能会受到max_allowed_packet参数的影响而导致插入失败；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--compress, -C在客户端和服务器之间启用压缩传递所有信息；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--debug，输出debug信息，用于调试。默认值为：d:t:o,/tmp/mysqldump.trace；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--debug-info，输出调试信息并退出；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">--delayed-insert采用延时插入方式（INSERT DELAYED）导出数据；</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--events, -E导出事件；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--flush-logs，开始导出之前刷新日志;</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">--flush-privileges，在导出mysql数据库之后，发出一条FLUSH PRIVILEGES 语句;</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--force，在导出过程中忽略出现的SQL错误；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--host, -h需要导出的主机信息；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;font-family:SimSun;">--lock-all-tables, -x提交请求锁定所有数据库中的所有表，以保证数据的一致性。这是一个全局读锁，并且自动关闭--single-transaction 和--lock-tables 选项;</span> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--single-transaction，InnoDB 表在备份时，通常启用选项 --single-transaction 来保证备份的一致性，实际上它的工作原理是设定本次会话的隔离级别为：REPEATABLE READ，以确保本次会话(dump)时，不会看到其他会话已经提交了的数据。</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">--lock-tables, -l开始导出前，锁定所有表；</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<br />\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<strong><span style="font-family:SimSun;">3.数据库恢复</span></strong> \r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">//恢复全部的数据库</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">mysql -uusername -p &lt; all_db.sql</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">//恢复指定的数据库是中的数据</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="font-family:SimSun;">mysql -uusername -p db_name &lt; db_name.sql</span>\r\n</p>\r\n<p style="font-family:Arial;font-size:15px;">\r\n	<span style="line-height:1.6;"><br />\r\n</span> \r\n</p>', 'zxb', NULL, '2016-07-29 20:29:21', '2016-07-29 20:29:21', 2);

-- --------------------------------------------------------

--
-- 表的结构 `blog_type`
--

CREATE TABLE IF NOT EXISTS `blog_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `blog_type`
--

INSERT INTO `blog_type` (`id`, `name`) VALUES
(1, 'default');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;