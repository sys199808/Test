<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class IndexController extends Controller
{
    /**
    *后台首页登录
     */
    public function index()
    {
//      $user = User::->first();
//      dd(session('user'));
        return view('admin.index',[]);
    }
    //  加载右侧显示页面
    public function info()
    {
        return view('admin.info');
    }
    //  退出登录 并销毁session
    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }
    // 修改密码页面
    public function pass()
    {
        return view('admin.user.pass');
    }
    // 处理修改密码数据
    public function dopass()
    {
//        dd(Input::all());
//        1、获取输入的数据
        $input = Input::except('_token');

//        2、验证规则：      数据     规则   提示信息
        $rule = [
            'pass_old'=>'required|between:5,20|alpha_num',
            'pass_new'=>'required|between:5,20|alpha_num',
            'pass_re'=>'required|same:pass_new',
        ];
        $mess = [
            'pass_old.required'=>'原密码不能空',
            'pass_old.between'=>'原密码不正确',
            'pass_old.alpha_num'=>'原密码必须包含数字、字母',
            'pass_new.required'=>'新密码不能为空',
            'pass_new.between'=>'新密码必须为5-20位',
            'pass_new.alpha_num'=>'新密码必须包含数字、字母',
            'pass_re.required'=>'密码不能为空',
            'pass_re.same'=>'确认密码必须与新密码一致',

        ];
//                                  数据     规则   提示信息
        $validator = Validator::make($input, $rule, $mess);

//        3、判断数据是否都通过检验 -如果失败返回错误信息
        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }

//        4、判断原密码是否正确
//        dd(session('user')->ad_id);
        $user = User::find(session('user')->ad_id);
        if($input['pass_old'] != Crypt::decrypt($user->ad_pass)){
            return back()->with('errors','原密码输入有误');
        }

//        5、判断新密码与重复密码是否一致 same已经判断了
//        6、更新数据库对应的密码
        $user->ad_pass = Crypt::encrypt($input['pass_new']);
        $res = $user->save();
//        7、判断是否修改成功
        if($res){
            return back()->with('errors','密码修改成功');
        }else{
            return back()->with('errors','密码修改失败');
        }
    }

}
