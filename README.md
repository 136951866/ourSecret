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
    

#11 model

1. 可以根据情况对当前的model模型进行个性化设置
2. 实例化model的三种方式
1.$goods =  new  命名空间GoodsModel();  
2.$goods = D(‘模型标志’);    
a)$goods = D(“Goods”);
b)该$goods是父类Model的对象，但是操作的数据表还是sw_goods
c)$obj = D();  实例化Model对象，没有具体操作数据表，与M()方法效果一致
3.$obj = M(); 
a)实例化父类Model
b)可以直接调用父类Model里边的属性，获得数据库相关操作
c)自定义model就是一个空壳，没有必要实例化自定义model
d)$obj = M(‘数据表标志’);  实例化Model对象，实际操作具体的数据表
$obj = D(标志);
$obj = D();
$obj = M(标志);
$obj = M();
D()和M()方法的区别：
前者是tp3.1.3里边对new操作的简化方法;
后者在使用就是实例化Model父类
    两者都在函数库文件定义ThinkPHP/Common/functions.php
注意：如果没有对应的model模型文件类，也可以直接实例化model对象进行操作
D()和M()方法都可以实例化操作一个没有具体model模型类文件的数据表。

#12 数据库
1. 配置
配置smarty behavior配置文件中
'TMPL_ENGINE_TYPE'      =>  'Smarty',
tp->smarty
a)  css样式如果有{}，需要使用{literal}标签禁止smarty解析
b)  关键字$Think 变为 $smarty
c)  tp引擎会对关键常量进行替换例如:__CONTROLLER__   __MODULE__
smarty引擎不给替换,需要设置为：{$smarty.const.__CONTROLLER__}

2. 各种查询条件设置
$obj = D();  创建对象
$obj -> select();  查询数据
select  字段，字段  from  表名  where 条件  group 字段 having  条件   order 排序  limit 限制条数;
SELECT%DISTINCT%%FIELD%FROM %TABLE%%JOIN%%WHERE%%GROUP%%HAVING%%ORDER%%LIMIT% %UNION%%COMMENT%

3. 语法
$obj -> field(字段，字段);  查询指定字段
$obj -> table(数据表);   设置具体操作数据表
$obj -> where(参数);   参数就是正常sql语句where后边的条件信息
例如：( “goods_price >100 and  goods_name like ‘三%’”)
$obj -> group(字段);  根据字段进行分组查询
$obj -> having(参数条件);  having 条件设置
$obj -> order(‘price  desc/asc’)  排序查询
$obj -> limit([偏移量，]条数)  限制查询的条数
sql语句里边具体的条件设置在tp框架model模型里边体现为具体的方法操作
以上方法理论上是父类Model的对应方法
父类model具体存在方法：   field()  where()   limit()
还有一些方法在__call()自动调用函数里边： table()  group()  order()  having()
    在__call()魔术方法里边会判断当前的执行方法是否是一个method属性的元素信息，如果存在就会执行执行
以上多个方法是同时使用多个进行条件显示（并且没有顺序要求）
$obj -> limit(5)->field(‘id,name’)->order(‘price asc’) -> table(‘sw_goods’)->select();
以上许多方法执行没有顺序要求，许多方法执行后都是把具体的参数赋予到model属性options里边,最后根据options拼装sql语句。

4. having()方法设置查询条件，where()设置查询条件
having  和 where区别
①   使用有先后顺序
②   where  price>100     having price>100
③   where  设置条件，字段必须是数据表中存在的字段 
④   having 设置条件，字段必须是select语句查询出来的字段可以使用
select goosd_price,goosd_name form sw_goods where goosd_price >100
select goosd_price,goosd_name form sw_goods  having goosd_price>100
只可以where
select goosd_name form sw_goods where goosd_price >100
select goosd_name form sw_goods having goosd_price >100 （error）
只可以having
//查询每种goosd_category_id商品的价格平均值，获取平均价格>1000
select goosd_category_id,avg(goods_price) as ag form sw_goods group by goosd_category_id having ag>1000

5. 其他方法
相关聚合函数 count()  sum()   avg()   max()   min()

6. 数据添加
select()
add() 该方法返回被添加的新记录的主键id值
save()
delete()
两种方式实现数据添加
1.数组方式数据添加
$goods = D(“Goods”);
$arr = array(‘goods_name’=>’iphone5s’,’goods_weight’=>’109’);
//注意:goods_name和goods_weight是数据表中字段名称
$goods -> add($arr);
2.AR方式实现数据添加
a)  ActiveRecord  活跃记录
b)  AR规定了程序与数据库之间的关系
c)  什么是AR：
d)  ① 一个数据表对应一个类model
e)  ② 一条数据记录对应类的一个对象
f)  ③ 每个字段对应该对象的具体属性
g)  tp框架的AR是假的
$goods = D(“Goods”);
$goods -> goods_name = “htc_one”;
$goods -> goods_price = 3000;
$goods -> add();
以上两种方式：数组、AR，最后add都要把新记录的主键id值返回
6. 收集数据
1.制作一个表单
2.通过$_POST收集信息
3.通过create()方法实现数据收集，该方法对于非法的字段会自动进行过滤
4.在create()收集表单方法内部会自动过滤非法的字段信息
7. 修改
select()
add()
save()  实现数据修改，返回受影响的记录条数
delete()
具体有两种方式实现数据修改，与添加类似(数组、AR方式)
1.数组方式
a)$goods = D(“Goods”);
b   $ar = array(‘goods_id’=>100,‘goods_name’=>’lenovo手机’,’goods_price’=>1200);
c)$goods ->where(‘goods_id>50’)-> save($ar);
2.AR方式
a)$goods = D(“Goods”);
b)$goods -> goods_id = 53;
c)$goods -> goods_name = “三星手机”;
d)$goods -> goods_price = 2000;
e)$goods -> where(‘goods_price>10000’)->save();
以上两种方式如果可行，即要修改全部数据
以上sql语句从技术上可行，从业务上不可行(事故)
tp框架有智能考虑，以上情况的sql语句不被允许执行。
如何执行：
①   明确告诉系统那条sql语句被update更新
②   可以设置where进行sql语句更新操作
save()  方法返回值
0：之前没有问题，执行前后数据没有变化
自然数：受影响的记录条数
false：执行失败

#13 数据传输
vc->view $this->assign('mg_id',$mg_id);(smarty)
view->vc url／method/mg_id/{$mg_id) 在method（¥arg）



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
D([“模型标志Goods”])(之前版本会实例化自定义model对象，目前都实例化Model基类对象)
M([模型标志]); 
D()和M()方法的区别：
前者是tp3.1.3里边对new操作的简化方法;
后者在使用就是实例化Model父类
    两者都在函数库文件定义ThinkPHP/Common/functions.php
注意：如果没有对应的model模型文件类，也可以直接实例化model对象进行操作
D()和M()方法都可以实例化操作一个没有具体model模型类文件的数据表。



