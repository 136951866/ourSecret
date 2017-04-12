<?php

header("content-type:text/html;charset=utf-8");
//tp->开发模式
define("APP_DEBUG", true);
define("SITE_URl","http://127.0.0.1/ourSecret/");
define("IMG_URL",SITE_URl."shop/public/Home/img/");
define("CSS_URL",SITE_URl."shop/public/Home/css/");
define("JS_URL",SITE_URl."shop/public/Home/js/");

define("ADMIN_IMG_URL",SITE_URl."shop/public/Admin/img/");
define("ADMIN_CSS_URL",SITE_URl."shop/public/Admin/css/");
define("ADMIN_JS_URL",SITE_URl."shop/public/Admin/js/");

include "../ThinkPHP/ThinkPHP.php";

?>