<?php
namespace Home\Controller;
use Think\Controller;
use Think\Verify;
class IndexController extends Controller {
    
    public function kaoqin(){
        $qiandao = "08:30";
        $qiantui = "17:30";
        $liuqiantui = "12:30";
        $kaoqin = M("kaoqin");
        $list = $kaoqin->group("kaoqinhao")->select();
        $arr = [];
        foreach ($list as $key => $value){
            $ulist = $kaoqin->where(["kaoqinhao"=>$value["kaoqinhao"]])->select();
            foreach ($ulist as $ke => $val){
                $arrs = [];
                if(date("w",$val["date"])!=0){
                    if(date("w",$val["date"])==6){
                        if($val["qiantui"]>$liuqiantui){
                            $arrs["qiantui"] = "√";
                        }else{
                            $arrs["qiantui"] = 0;
                        }
                    }else{
                        if($val["qiantui"]>$qiantui){
                            $arrs["qiantui"] = "√";
                        }else{
                            $arrs["qiantui"] = 0;
                        }
                    }
                    
                    if($val["qiandao"]<$qiandao){
                        $arrs["qiandao"] = "√";
                    }else{
                        $arrs["qiandao"] = 0;
                    }
                    
                    if($arrs["qiandao"]&&$arrs["qiantui"]){
                        $arrs["status"] = 1;
                    }else{
                        $arrs["status"] = 1;
                        if(!$arrs["qiandao"]){
                            $arrs["status"] = 2;
                        }
                        if(!$arrs["qiantui"]){
                            $arrs["status"] = 3;
                        }
                    }
                }else{
                    $arrs = ["status"=>0,"qiandao"=>0,"qiantui"=>0];
                }
                
                $arr[$value["kaoqinhao"]][$val["date"]] =  $arrs;
            }
        var_dump($arr);
            die;
        }
    }
    /* 生成验证码 */
    /* public function verify()
    {
        $config = [
            'fontSize' => 19, // 验证码字体大小
            'length' => 4, // 验证码位数
            'imageH' => 34
        ];
        $Verify = new Verify($config);
        $Verify->entry();
    } */
    public function index(){
        echo 'Hello World!';die;
        $goods = M('goods');
        $where = "1=1";
        $name = I('name');
        if($name){
            $where .= " and goods_name like '%".$name."%'";
        }
        $num = I('num');
        if($num){
            $where .= " and goods_num='".$num."'";
        }
        $count = I('count');
        if($count){
            $where .= " and counts > '".$count."'";
        }
        
        $count      = $goods->where($where)->count();// 查询满足要求的总记录数
        $Page       = new \Think\Page($count,2);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show       = $Page->show();// 分页显示输出
        // 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $goods->where($where)->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
        $this->assign('list',$list);// 赋值数据集
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    public function  add(){
        $post = I('post.');
        if(!empty($post)){
            /* $res = $this->check_verify($post['j_verify']);
            if($res){ */
                
                $upload = new \Think\Upload();// 实例化上传类
                $upload->maxSize   =     3145728 ;// 设置附件上传大小
                $upload->exts      =     array('jpg','png');// 设置附件上传类型
                $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
                $upload->savePath  =     ''; // 设置附件上传（子）目录
                // 上传文件
                $info   =   $upload->upload();
                /* if(!$info) {// 上传错误提示错误信息
                    $this->error($upload->getError());
                }else{// 上传成功 */
                    
                     /* $image = new \Think\Image();
                    // 在图片右下角添加水印
                   $image->open('Uploads/'.$info['file']['savepath'].$info['file']['savename'])
                    ->water("Uploads/baidu_jgylogo3.gif",\Think\Image::IMAGE_WATER_NORTHWEST,50)
                    ->save('Uploads/'.$info['file']['savepath'].$info['file']['savename']); */
                    
                    $arr = array(
                        "goods_name"=>$post["goods_name"],
                        "goods_num"=>$post["goods_num"],
                        "goods_price"=>$post["goods_price"],
                        "counts"=>$post["counts"],
                        "file"=> $info['file']['savepath'].$info['file']['savename'],
                        "createtime"=>time(),
                    );
                    $id = M("goods")->add($arr);
                    if($id){
                        $this->success("成功");
                    }
                //}
                
            /* }else{
                $this->error("验证码错误");
            } */
        }else{
            $id = I("get.id");
            if($id){
                $goods = M('goods');
                $info = $goods->where("id=".$id)->find();
                $this->assign("info",$info);
            }
            $this->display('add');
        }
       
    }
    
    function login(){
        $this->display("login");
    }
    
    
    
    function check_verify($code, $id = ''){
        $verify = new \Think\Verify();
        return $verify->check($code, $id);
    }
}