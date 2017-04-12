<?php
namespace Home\Controller;
use Think\Controller;
class GoodsController extends Controller {
	function showlist(){
		echo R("shop://Home/User/number");
		$this->display();
	}

	function detail(){
		$this->display();
	}
}