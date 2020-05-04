<?php
namespace app\admin\validate;
use think\Validate;

class Admin extends Validate
{
    protected $rule = [
        'username' => 'require|max:25',
        'password' => 'require'
    ];

    protected $message = [
        'username.require' => '名称必填',
        'username.max' => '名称最多填写25个字符串',
        'password.require' => '密码必填'
    ];

    protected $scene = [
        'add' => ['username','password']
    ];  
        
}


