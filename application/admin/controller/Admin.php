<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Admin as AdminModel;

class Admin extends Controller
{
    public function lst()
    {
        $list = AdminModel::paginate(10);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $admins = db('admin')->find($id);

        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'username'=>input('username')
            ];
            if(input('password')){
                $data['password']=md5(input('password'));
            }else{
                $data['password']=$admins['password'];
            }
            $validate = Loader::validate('Admin');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
                die;
            }
            if(db('admin')->update($data)){
                $this->success('修改信息成功！','lst');
            }else{
                $this->error('修改信息失败！');
            }
            return;
        }

        $this->assign('admins',$admins);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=[
                'username'=>input('username'),
                'password'=>md5(input('password'))
            ];
            $validate = Loader::validate('Admin');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
                die;
            }
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


