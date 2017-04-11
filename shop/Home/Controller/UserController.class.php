<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	function login(){
		echo U("User/login");
		echo "<br>";
		echo "login";
	}

	function register(){
		echo "register";
	}
}