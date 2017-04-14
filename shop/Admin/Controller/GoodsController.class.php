<?php
namespace Admin\Controller;
use Think\Controller;
class GoodsController extends Controller {

	function showlist(){
		// $goods = new \Model\GoodsModel();
		$goods = D("Goods");
		$info = $goods->select();
		$info = $goods->field("goods_id,goods_name,goods_price,goods_number,goods_create_time")->select();
		$this->assign('info',$info);
		$this->display();
	}

	function add(){
		// $goods = D("Goods");
		// $arr = array(
		// 	'goods_name'=>'hanktest',
		// 	'goods_price'=>100000,
		// 	'goods_number'=>53;
		// 	)
		// if($goods->add($arr)>0){

		// }
		// $goods = D("Goods");
		// $goods->goods_name="hanktest";
		// $goods->goods_price=100000;
		// $goods->goods_number=53;
		// if($goods->add()){
		// 	echo "sucess";
		// }
		$goods = D("Goods");
		if(!empty($_POST)){
			// $arr = $_POST;
			// $z = $goods->add($arr);
			$goods->create();//收集POST表单
			$z = $goods->add();
			if($z){
				//jump url
				$this->success('add sucess',U("Goods/showlist"));
			}else{
				$this->error('add failure',U("Goods/showlist"));
			}
		}else {
			$this->display();
		}
	}

	function upd($goods_id){
		$goods = D("Goods");
		if(!empty($_POST)){
			// $arr = $_POST;
			// $z = $goods->add($arr);
			$goods->create();//收集POST表单
			$z = $goods->save();
			if($z){
				$this->success('add sucess',U("Goods/showlist"));
			}else{
				$this->error('add failure',U("Goods/showlist"));
			}
		}else {
			$info=$goods->find($goods_id);
			$this->assign('info',$info);
			$this->display();
		}
	}

}