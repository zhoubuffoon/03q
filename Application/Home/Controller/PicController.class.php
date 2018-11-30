<?php
namespace Home\Controller;
use Think\Controller;
class PicController extends Controller {
    public function index(){
        $goods = M('goods');
        $list = $goods->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display('index');
    }
}