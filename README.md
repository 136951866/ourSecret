#1. 框架项目部署
把tp框架的ThinkPHP文件夹放到我们的项目中
在与ThinkPHP文件创建自己的项目模块文件夹
创建入口文件index.php
项目模块文件夹的Controller用于放控制器 命命用模块+Controller.class.php

#2. 路由解析
1. 通过url地址参数找到指定的控制器，并进行对于方法调用请求
访问
以上url地址信息不安全
tp框架url地址可以由以下四种
http://网址/index.php?m=XX&c=XX&a=XX   基本get模式
  http://127.0.0.1/ourSecret/shop/index.php?m=Home&c=Goods&a=detail
http://网址/index.php/模块/控制器/操作方法  路径模式pathinfo
  http://127.0.0.1/ourSecret/shop/index.php/Home/Goods/detail
http://网址/模块/控制器/操作方法           rewrite重写模式
http://网址/index.php?s=/模块/控制器/方法    兼容模式
  http://127.0.0.1/ourSecret/shop/index.php?s=/Home/Goods/detail

2. ThinkPHP/Conf/convention.php
URL_MODEL = 4种url地址模式
自己的配置文件
自己模块的Conf／config.php
config.php是我们当前自己项目的配置文件，我们可以通过修改该文件达到配置变量的目录这个文件在系统运行过程中会覆盖convertion.php的配置变量

#3. 开发生产模式

开发 需要加载26个文件
生产 系统只需要加载很少文件
index.php  define(“APP_DEBUG”,true);
观察系统运行过程中生成的日志信息：
1. 做变量配置，convertion.php , config.php
2. tp框架配置变量：convertion.php   Behavior行为文件    程序灵活设置
Behavior  行为：ThinkPHP/Library/Behavior/*
$option里边的信息是可以直接通过config.php进行修改的

