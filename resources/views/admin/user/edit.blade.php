@extends('layouts.admin')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">用户管理</a> &raquo; 用户编辑
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
            @if (count($errors) > 0)
                <div class="mark">
                    <ul>
                        @if(is_object($errors))
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        @else
                            <li>{{ session('errors') }}</li>
                        @endif
                    </ul>
                </div>
            @endif
        </div>
        <script>
            $(function(){
                $('.mark').fadeOut(5000, function () {
                    $(this).css('display','none');
                });
            })
        </script>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{ url('admin/user') }}"><i class="fa fa-plus"></i>用户列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form id="user_info" action="{{ url('admin/user/'.$user->ad_id) }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            {{--将提交方式修改为put方式  -->{{method_field('put')}}--}}
            <input type="hidden" name="_method" value="put">
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th width="120"><i class="require">*</i>录入职位：</th>
                        <td>
                            <select name="role_id">
                                <option value="{{ $user->role_id }}">{{ $user->post }}</option>
                                @foreach($roles as $role)
                                    @if($user->post != $role->post)
                                <option value="{{ $role->role_id }}">{{ $role->post }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>用户名：</th>
                        <td>
                            <input type="text" name="ad_name" value="{{ $user->ad_name }}">
                            <p>用户名请输入6-18位</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>密 码：</th>
                        <td>
                            <input type="password" name="ad_pass" value="{{ $user->ad_pass }}" disabled>
                            <input type="hidden" name="ad_time" value="{{ date('Y-m-d H:i:s',$user->ad_time) }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>初始密码默认为：111111</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>工 号：</th>
                        <td>
                            <input type="text" name="ad_num" value="{{ $user->ad_num }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度-6</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>电 话：</th>
                        <td>
                            <input type="text" name="ad_phone" value="{{ $user->ad_phone }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>！！！</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>籍 贯：</th>
                        <td>
                            <input type="text" name="ad_address" value="{{ $user->ad_address }}">
                            <span><i class="fa fa-exclamation-circle yellow"></i>请以身份证为准！！！</span>
                            <p>xxx省xxx市</p>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>缩略图：</th>
                        <td>
                            <input type="text" name="ad_photo" id="art_thumb" value="{{ $user->ad_photo }}">
                            <input id="pic_upload" type="file" name="pic_upload" multiple="true">
                            <p><img id="img"  title="pic" src="{{ '/'.$user->ad_photo }}" width="100" alt="上传后显示图片"></p>
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
                                /*var formData = $('input[type=file]').val();*/
                                var formData = new FormData($('#user_info')[0]);
                                formData.append('_token', '{{ csrf_token() }}');
                                console.log(formData);
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
                </tbody>
            </table>
        </form>
    </div>
</body>
@endsection