<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
	function index($mg_id){
		$this->assign('mg_id',$mg_id);
		$this->display();
	}
	function head($mg_id){
		$user = new \Model\ManagerModel();
		$user=$user->find($mg_id);
		$this->assign('user',$user);
		$this->display();
	}
	function left(){
		$this->display();
	}
	function right($mg_id){
		$user = new \Model\ManagerModel();
		$user=$user->find($mg_id);
		$this->assign('user',$user);
		$this->display();
	}
}