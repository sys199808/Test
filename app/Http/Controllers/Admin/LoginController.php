<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//require_once app_path().'/Org/code/Code.class.php';
//use App\Org\code\Code;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;


class LoginController extends Controller
{
    /**
     * @功能：后台登录页面
     * @author
     * @date
     * @param
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('admin.login');
    }

    /**
     * @功能：验证码
     * @date
     */
    /*public function yzm()
    {
        $code = new Code();
//        dd($code);
        $code->make();
    }*/

    public function captcha($tmp)
    {
        $phrase = new PhraseBuilder;
        // 设置验证码位数
        $code = $phrase->build(4);
        // 生成验证码图片的Builder对象，配置相应属性
        $builder = new CaptchaBuilder($code, $phrase);
        // 设置背景颜色
        $builder->setBackgroundColor(220, 210, 230);
        $builder->setMaxAngle(25);
        $builder->setMaxBehindLines(0);
        $builder->setMaxFrontLines(0);
        // 可以设置图片宽高及字体
        $builder->build($width = 100, $height = 40, $font = null);
        // 获取验证码的内容
        $phrase = $builder->getPhrase();
        $phrase = strtoupper($phrase);
        // 把内容存入session
        Session::flash('code', $phrase);
        // 生成图片
        header("Cache-Control: no-cache, must-revalidate");
        header("Content-Type:image/jpeg");
        $builder->output();
    }
    /**
     * @功能：验证码
     * @date
     */
    public function dologin()
    {
//        也可以用request
//        1、得到表单的值
        $info = Input::except('_token');
//        dd($info);
//        2、验证用户名、密码、验证码
        $user = User::where('ad_name',$info['ad_name'])->select()->first();
//        dd($user);
        if(!$user) {
            return back()->with('error','没有此用户')->withInput();
        }

//        密码
        if(Crypt::decrypt($user->ad_pass) != trim($info['ad_pass'])) {
            return back()->with('error','密码不正确')->withInput();
        }

//        验证码
        if( strtoupper($info['code']) != session('code')) {
            return back()->with('error','验证码不正确')->withInput();
        }

//        3、成功后保存登录信息
        session(['user'=>$user]);
        return redirect('/admin/index');

//        4、如果失败返回登录页面

    }

//    加密
    public function crypt()
    {
//        $p = 111111;
//        $p = 'eyJpdiI6IkdzR3RIU25majhZZlhuOTJzWlFZU2c9PSIsInZhbHVlIjoibFVTRkowaFBOY1lzMm14dTRieUpRUT09IiwibWFjIjoiODFhZWNlNGYzNjc4MDk4YzllZTgyMjRiNWRiYTYwYjFkMzViZjVmYzA5ZTIxMzIyMjNhNDc5MzA5YjhiMmU2YSJ9';
//        echo Crypt::encrypt($p);
//        echo Crypt::decrypt($p);
//        echo Hash::make('123456');
//        echo md5('salt_qwe'.$p);
    }
}

