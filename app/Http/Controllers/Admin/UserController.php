<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Role;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * 头像文件的处理
     *
     * @return \Illuminate\Http\Response
     */
    public function picUpload()
    {
        $file = Input::file('ad_photo');
//      检查文件是否有效
        if($file->isValid()){
//            文件后缀名
            $ext = $file->getClientOriginalExtension();
//            保存在服务器上的新文件名
            $newName = date('YmdHis').mt_rand(11111,99999).'.'.$ext;
//            将文件从临时目录移动到指定目录
            $file->move(public_path().'/uploads',$newName);
            $filepath = 'uploads/'.$newName;
            return  $filepath;
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.user.list',compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
//      dd($roles);
        return view('admin.user.add',['roles'=>$roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        处理接收数据的业务逻辑
//    1、获取接收数据 头像另做处理 picUpload()
//    2、表单验证 Validator::make($input, $rule, $mess);
//    3、发送ajax
//    4、如果验证失败，返回继续填写
//    5、成功则更新用户表 同时更新用户角色表 role_user
//    6、返回用户列表页
        dd($request->except('_token','ad_photo'));

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
