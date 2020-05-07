<?php
namespace app\admin\validate;
use think\Validate;

class Cate extends Validate
{
    protected $rule = [
        'catename' => 'require'
    ];

    protected $message = [
        'catename.require' => '名称必填'
        ];

    protected $scene = [
        'add' => ['catename'],
        'edit' => ['catename']
    ];  
        
}


