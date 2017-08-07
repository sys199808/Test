@extends('layouts.admin')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 用户添加
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>新增文章</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form id="user_info" action="{{ url('admin/user') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>录入职位：</th>
                        <td>
                            <select name="role_id">
                                <option value="">==请选择==</option>
                                @foreach($roles as $role)
                                <option value="{{ $role->role_id }}">{{ $role->post }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>用户名：</th>
                        <td>
                            <input type="text" name="ad_name" value="">
                            <p>用户名请输入6-18位</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>密 码：</th>
                        <td>
                            <input type="password" name="ad_pass" value="111111" disabled>
                            <span><i class="fa fa-exclamation-circle yellow"></i>初始密码默认为：111111</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>工 号：</th>
                        <td>
                            <input type="text" name="ad_num">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度-6</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>电 话：</th>
                        <td>
                            <input type="text" name="ad_phone">
                            <span><i class="fa fa-exclamation-circle yellow"></i>请输入正确电话！！！</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>籍 贯：</th>
                        <td>
                            <input type="text" name="ad_address">
                            <span><i class="fa fa-exclamation-circle yellow"></i>请以身份证为准！！！</span>
                            <p>xxx省xxx市</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>缩略图：</th>
                        <td>
                            <input type="text" name="art_thumb" id="art_thumb" placeholder="显示图片路径">
                            <input id="pic_upload" type="file" name="ad_photo" multiple="true">
                            <p><img id="img" title="pic" alt="上传后显示图片"></p>
                        </td>
                        <script type="text/javascript">
                            $(function () {
                                $('#pic_upload').change(function () {
                                    uploadImage();
                                });
                            });
                            function uploadImage() {
                                /*1、判断是否有文件上传
                                 2、检验文件后缀名是否符合标准
                                 3、成功后发送ajax*/
                                var imgPath = $('#pic_upload').val();
                                if(imgPath == ""){
                                    alert("请选择上传的图片！");
                                    return;
                                }

                                var strExt = imgPath.substr(imgPath.lastIndexOf('.') + 1);
                                if(strExt != 'jpeg' && strExt != 'jpg' && strExt != 'png' && strExt != 'gif' && strExt != 'bmp'){
                                    alert("请选择图片格式上传！");
                                    return;
                                }
                                var formData = new FormData($('#user_info')[0]);
                                {{-- formData.append('_token', '{{csrf_token()}}'); --}}
                                {{-- console.log(formData);--}}
                                $.ajax({
                                    url: "/admin/upload",
                                    data: formData,
                                    /*dataType:'json',我传的不是json数据*/
                                    type: "POST",
                                    async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
//                                      console.log(data);
                                        alert("上传成功");
                                        $('#img').attr({src:'/'+data,width:"100"});
                                        $('#art_thumb').val(data);

                                    },
                                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                                        alert("上传失败，请检查网络后重试");
                                    }
                                });
                            }

                        </script>

                    </tr>
                    <tr>
                        <th></th>
                        <td>
                            <input type="submit" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>内 容：</th>
                        <td>
                            <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.config.js')}}"></script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/ueditor.all.min.js')}}"> </script>
                            <script type="text/javascript" charset="utf-8" src="{{asset('ueditor/lang/zh-cn/zh-cn.js')}}"></script>
                            <script id="editor" type="text/plain" style="width:800px;height:300px;"></script>
                            <script type="text/javascript">

                                //实例化编辑器
                                //建议使用工厂方法getEditor创建和引用编辑器实例，如果在某个闭包下引用该编辑器，直接调用UE.getEditor('editor')就能拿到相关的实例
                                var ue = UE.getEditor('editor');
                            </script>

                            <style>
                                .edui-default{line-height: 28px;}
                                div.edui-combox-body,div.edui-button-body,div.edui-splitbutton-body
                                {overflow: hidden; height:20px;}
                                div.edui-box{overflow: hidden; height:22px;}
                            </style>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
</body>
@endsection