<?php
namespace Home\Controller;
use Think\Controller;
class UserController extends Controller {
	function login(){
		//
		$this->display();
	}

	function register(){
		$this->display();
	}

	function number(){
		echo "200w";
	}

	function _empty(){
		echo "<img src='".IMG_URL.'404.jpeg'."' alt='center' />";
	}
}