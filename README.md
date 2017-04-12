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

#4. 控制器调用模版

控制器的方法调用$this->display();//调用视图模版
$this->display()调用的view是view目录下/控制器名字的目录/方法名字.html

控制器和模板的关系
通常：在view目录通常会有一个与控制器标志一样的目录，里边有具体模板文件
        例如GoodsController.class.php 控制 在view目录有Goods目录，里边都是Goods控制器对应的模板文件

#5. 定义常量
define("SITE_URl","http://127.0.0.1/ourSecret/");
define("IMG_URL",SITE_URl."shop/public/img/");
define("CSS_URL",SITE_URl."shop/public/css/");
define("JS_URL",SITE_URl."shop/public/js/");

//URL不区别大小写
'URL_CASE_INSENSITIVE'   => true,

#6. 空操作
1. 空操作：就没有指定的操作方法
空控制器：没有指定控制器
http://网址/index.php/Home/User/login
http://网址/index.php/Home/User/hello 空操作
http://网址/index.php/Home/beijing/login   空控制器
2. 空操作：
    一般网站处于安全考虑不给用户提示任何错误信息
    “空操作”本质意思：一个对象(控制器)调用本身不存在的方法
    在OOP里边，对象调用本身不存在方法，处于用户体验比较好的角度考虑，我们可以在类里边制作一个魔术方法：function __call();
    普通控制器父类的位置：
空操作有两种解决方案：
①   在对应的控制器里边制作一个方法，名称为”_empty”,这个控制器的空操作都会自动执行该方法。（推荐使用）
②   给空操作的名称制作一个同名的模板出来，系统会自动调用
3. 空控制器
    http://网址/index.php/Home/tianjin/login
     
    空控制器：在实例化控制器对象的时候，没有找到指定的类
    什么时候实例化控制器对象：ThinkPHP/Library/Think/App.class.php
    熟记文件：
        index.php  入口文件
        ThinkPHP/ThinkPHP.php  框架核心文件
        ThinkPHP/Library/Think/Think.class.php  框架核心文件
        ThinkPHP/Library/Think/App.class.php  框架应用文件
            App.class.php内部包括控制器对象创建，以及对象调用指定的方法呈现内容。

    快捷操作方法：
    空控制器处理方案：可以再制作一个控制器，名称EmptyController.class.php
    在该控制器内部其实只需要制作一个_empty()方法即可。
     
#7.项目分组
系统有前台用户操作界面
系统还有后台供公司内部人员使用维护平台
两者在使用的过程中就是对“控制器”、“视图模板”、“model模型”的操作

为了系统开发方便，及代码部署更加合理，我们的控制器、view视图等前后台文件不要混在起，要在物理结构上给分开
 
//前台
http://网址/index.php/Home/控制器/操作方法     访问Home控制器及制定操作
//后台
http://网址/index.php/Admin/控制器/操作方法     访问Admin分组的控制器和操作方法

#8.系统的常量已经被替换了所以不需要用
__CONTROLLER__通过行为会被替换成常量信息
行为：ThinkPHP/Library/Behavior/ContentReplaceBehavior.class.php进行的替换

#9.跨控制器调用

一个控制器在执行的时候，可以实例化另外一个控制，并通过对象访问其指定方法。
跨控制器调用可以节省我们代码的工作量
例如：有10个页面，都要现实指定的数据信息显示。比如我们网站的“会员数目有200万”，这个信息需要在10个页面都显示
这个数据是通过UserController.class.php 里边额方法number()给查询出来的
现在商品列表页面也需要显示200万会员数目信息，那么原则上就是GoodsController.class.php里边也有一个方法number()专门获得会员数目的
如果许多页面都需要显示200万的会员数据，则许多控制器都需要有number()方法。
如果大家都能实例化User控制器，并调用它的number()方法，则会节省许多重复劳动。

系统函数库：ThinkPHP/Common/functions.php

自动加载机制
ThinkPHP/Library/Think/Think.class.php    function autoload();
  
        $user = new UserController();== $user = A("Home/User");== $user = A("shop://Home/User");
        echo $user->number(); 
        = echo R("User/number");=echo R("shop://home/User/number");
        
#10.tp的执行流程

1. index.php  入口文件
2. ThinkPHP/ThinkPHP.php
    在php5.3版本以后
    设置常量有两种方式：
    const name = value;  作用域根据当前命名空间决定
    define()  作用域全局
    ① 定义了许多常量
    ② 引入核心文件Think.class.php
    Think::start();
3. ThinkPHP/Library/Think/Think.class.php
    static function start()
    ① 引入系统核心文件
    ② 引入配置文件
    ③ 如果是生成模式，还会生成common~runtime.php文件
    ④ 如果是第一次使用系统，还会自动创建对应的应用目录
    App::run();
4. ThinkPHP/library/Think/App.class.php
    static function run()
      App::init();
        路由解析
        //路由解析,把模块、控制器、方法赋予常量
        //MODULE_NAME = 模块名称
        //CONTROLLER_NAME  控制器
        //ACTION_NAME  方法
      App::exec()
        实例化控制器对象
        利用“反射”实现对象调用方法
    







#*简便函数
U() 制作url地址的快捷函数
C(名称) 获得配置变量(convertion.php  config.php)信息
C(名称，值)  设置配置变量信息
L()  获得语言变量信息
E()  给页面输出错误信息
A("项目://模块/控制器")  实例化控制器对象
A("Home/User")    实例化User控制器对象
A("book://Home/User")    实例化book项目的Home模块的User控制器对象
A(“[模块/]控制器标志”) 实例化控制器对象
R([模块/]控制器标志/操作方法)  实例化对象同时调用指定方法


    


