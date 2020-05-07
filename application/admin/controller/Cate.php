<?php
namespace app\admin\Controller;
use think\Controller;
use think\Db;
use think\Loader;
use app\admin\model\Cate as CateModel;

class Cate extends Controller
{
    public function lst()
    {
        $list = CateModel::paginate(10);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit()
    {
        $id = input('id');
        $Cates = db('cate')->find($id);

        if(request()->isPost()){
            $data = [
                'id'=>input('id'),
                'catename'=>input('catename')
            ];
            $validate = Loader::validate('Cate');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
                die;
            }
            if(db('cate')->update($data)){
                $this->success('修改信息成功！','lst');
            }else{
                $this->error('修改信息失败！');
            }
            return;
        }

        $this->assign('Cates',$Cates);
        return $this->fetch();
    }

    public function add()
    {
        if(request()->isPost()){
            $data=[
                'catename'=>input('catename')
            ];
            $validate = Loader::validate('Cate');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
                die;
            }
            if(Db::name('cate')->insert($data)){
                return $this->success('添加栏目成功！','lst');
            }else{
                return $this->error('添加栏目失败！');
            }
            return;
        }
        return $this->fetch();
    }

    public function del()
    {
        $id = input('id');
            if(db('cate')->delete($id)){
                $this->success('删除成功','lst'); 
            }else{
                $this->error('删除失败');
            }
    }
}


