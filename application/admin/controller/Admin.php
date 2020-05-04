<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;

class Admin extends Controller
{
    public function lst()
    {
        return $this->fetch();
    }
    public function add()
    {
        if(request()->isPost()){
            $data=[
                'username'=>input('username'),
                'password'=>md5(input('password'))
            ];
            if(Db::name('admin')->insert($data)){
                return $this->success('添加管理员成功！','lst');
            }else{
                return $this->error('添加管理员失败！');
            }
            return;
        }
        return $this->fetch();
    }
}


