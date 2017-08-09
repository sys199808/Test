<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Role;
use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * 头像文件的处理
     *
     * @return \Illuminate\Http\Response
     */
    public function picUpload()
    {
        $file = Input::file('pic_upload');
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
    public function index(Request $request)
    {
//        $user = User::all();
        $user = User::leftJoin('admin_roles','admin_users.role_id','=','admin_roles.role_id')->where('ad_name','like','%'.$request['keywords'].'%')->orderBy('admin_users.ad_id')->paginate(3);
//        dd($user);
//        $data = User::where('ad_name','like','%'.$request['keywords'].'%')->paginate(3);
        $keyword = $request->input('keywords');
//        dd($keyword);
        return view('admin.user.list',compact('user','keyword'));
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
        $photo = '/^1[3578]\d{9}$/';
        $rule = [
            'role_id'=>'required',
            'ad_name'=>'required|between:5,18|alpha',
            'ad_num'=>'required|size:6',
            'ad_phone'=>'required|regex:'.$photo,
            'ad_address'=>'required|string',
        ];
        $mess = [
            'ad_name.required'=>'用户名必须输入',
            'ad_name.between'=>'用户名必须在5-18位之间',
            'ad_name.alpha'=>'用户名必须为字母',
            'ad_num.required'=>'工号必须输入',
            'ad_num.size'=>'工号长度必须为6',
            'ad_phone.required'=>'工号必须输入',
            'ad_phone.regex'=>'手机号必须符合长度',
            'ad_address.required'=>'地址不能为空',
            'ad_address.string'=>'地址必须符合规范',
            'role_id.required'=>'请选择职位',

        ];
        $input = $request->except('_token','pic_upload');
        $validator = Validator::make($input,$rule,$mess);
//        如果表单验证失败
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
//    2、表单验证 Validator::make($input, $rule, $mess);
//    3、发送ajax
//    4、如果验证失败，返回继续填写

//    5、成功则更新用户表 同时更新用户角色表 role_user

        $input['ad_pass'] = Crypt::encrypt(111111);
        $res = User::create($input);

//    6、返回用户列表页
        if($res){
            return redirect('admin/user');
        }else{
            return back()->with('errors','用户添加失败');
        }
//        dd($request->except('_token','ad_photo'));

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
        $user = User::join('admin_roles','admin_users.role_id','=','admin_roles.role_id')->where('admin_users.ad_id',$id)->first();
        $user->ad_pass = Crypt::decrypt($user->ad_pass);
//        dd($user);
        $roles = Role::all();
        return view('admin/user/edit',compact('user','roles'));
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
        $userInfo = $request->except('_token','_method','pic_upload');
        $userInfo['ad_time'] = time();
        //根据id获取要修改的用户
        $user = User::find($id);
        $photo = $user->ad_photo;
        $res = $user->update($userInfo);
//        把表单验证加上
        if($res){
//            修改成功，返回用户列表页
//            $this->removeFilter('/'.$photo);
            return redirect('admin/user');

        }else{
            return back()->with('errors','用户修改失败');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        取出头像路径
        $user = User::find($id);
        $photo = $user->ad_photo;
        $res = User::where('ad_id',$id)->delete();
//        删除成功
        if($res){
//            Storage::delete("/".$photo);
            $data = [
                'status'=>1,
                'msg'=>'删除成功',
            ];
        }else{
//            Storage::delete('/'.$photo);
            $data = [
                'status'=>0,
                'msg'=>'删除失败',
            ];
        }

        return json_encode($data);
//          return $data;
//          return response()->json($data);
//          dd($data);
//          return  json_parse($data);
    }
}
