@extends('layouts.admin')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="#">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 添加商品
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>快捷操作</h3>
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="#"><i class="fa fa-plus"></i>商品列表</a>
                <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form id="user_info" action="{{ url('admin/cars') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <table class="add_tab">
                <tbody>
                    <tr>
                        <th><i class="require">*</i>用户名：</th>
                        <td>
                            <input type="text" name="user_name">
                        </td>
                        <th><i class="require">*</i>用户电话：</th>
                        <td>
                            <input type="text" name="user_phone">
                            <span><i class="fa fa-exclamation-circle yellow"></i>请准确填写用户联系方式</span>
                            <p>请准确填写用户联系方式</p>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>品牌：</th>
                        <td>
                            <select name="cars_pp" id="carsPP">
                                <option  value="null">==请选择==</option>
                                @foreach($pp as $v)
                                <option class="cars_pp" value="{{ $v->p_id }}">{{ $v->p_name }}</option>
                                    @endforeach
                            </select>
                            <script type="text/javascript">
                                $.ajaxSetup({
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    }
                                });

                                $('#carsPP').change(function(){
                                    var pid = $(this).val();
                                    $.ajax({
//                                        注意路由不要写错,字母不要写错
                                        url: "/admin/sort",
                                        type: "POST",
                                        data: "pid="+pid,
                                        success: function(data){
                                            console.log(data);

                                        },
                                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                                            alert("选择失败，请检查网络后重试");
                                        },
                                        async:true,
                                    });


                                });
                                /*$.ajax({
                                    url:,
                                    type:'get',
                                    dataType:'json',
                                    data:{upid:0},
                                    success:function(data){
                                        for (var i = 0; i < data.length; i++) {
                                            $('#cid').append("<option value="+data[i].id+">"+data[i].name+'</option>');
                                        }
                                    }
                                });

                                $("body").on('change','select',function(){
                                    $(this).nextAll('select').remove();
                                    var v = $(this).val();
                                    var name = $(this).attr('name');
                                    if(v != '==请选择=='){
                                        var ob = $(this);
                                        $.ajax({
                                            url:url,
                                            type:'get',
                                            dataType:'json',
                                            data:{upid:v},
                                            success:function(data){
                                                if(data.length>0){
                                                    if(name == 'province'){
                                                        var select = $("<select name='city' id='city'><option>---请选择---</option></select>");
                                                    }else{
                                                        var select = $("<select name='county' id='county'><option>---请选择---</option></select>");
                                                    }
                                                    for (var i = 0; i < data.length; i++) {
                                                        $(select).append("<option value="+data[i].id+">"+data[i].name+'</option>');
                                                    }
                                                    ob.after(select);
                                                }
                                            }
                                        });
                                    }
                                });*/
                            </script>
                        </td>
                        <th width="120"><i class="require">*</i>车系：+SUV车型</th>
                        <td>
                            <select name="cars_sort">
                                <option value="">==请选择==</option>
                                @foreach($sort as $k=>$v)
                                <option value="{{ $v->car_id }}">{{ $v->car_name }}</option>
                                    @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>年款：</th>
                        <td>
                            <select name="cars_kuanShi">
                                <option value="">==请选择==</option>
                                @foreach($kuanShi as $v)
                                <option value="{{ $v->kuan_id }}">{{ $v->kuan_type }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <th width="120"><i class="require">*</i>排量：</th>
                        <td>
                            <select name="cars_paiLiang">
                                <option value="">==请选择==</option>
                                @foreach($paiLiang as  $v)
                                <option value="{{ $v->pai_id }}">{{ $v->pai_type }}</option>
                                    @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>变速箱：</th>
                        <td>
                            <select name="cars_bianSu">
                                <option value="">==请选择==</option>
                                @foreach($bianSu as $v)
                                <option value="{{ $v->bian_id }}">{{ $v->bian_type }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <th width="120"><i class="require">*</i>舒适类型：</th>
                        <td>
                            <select name="cars_shuShi">
                                <option value="">==请选择==</option>
                                @foreach($shuShi as $v)
                                <option value="{{ $v->shu_id }}">{{ $v->shu_type }}</option>
                                    @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120"><i class="require">*</i>排放标准：</th>
                        <td>
                            <select name="cars_paiFang">
                                <option value="">==请选择==</option>
                                @foreach($paiFang as $v)
                                <option value="{{ $v->fang_id }}">{{ $v->fang_type }}</option>
                                    @endforeach
                            </select>
                        </td>
                        <th><i class="require">*</i>上牌时间：</th>
                        <td>
                            <input class="easyui-datebox" name="cars_time" required="required" height="20" data-options="formatter:myformatter,parser:myparser">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>过户次数：</th>
                        <td>
                            <input type="text" class="sm" name="">次
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>
                        <th><i class="require">*</i>行驶里程：</th>
                        <td>
                            <input type="text" name="cars_liCheng"><span>万公里</span>
                        </td>
                    </tr>
                    <tr>
                        <th>上牌地：</th>
                        <td>
                            <select name="cars_shangPai">
                                <option value="">==请选择==</option>
                                @foreach($address as $v)
                                    <option value="{{ $v->city_id }}">{{ $v->city_name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <th>看车地址：</th>
                        <td>
                            <select name="cars_kanChe">
                                <option value="">==请选择==</option>
                                @foreach($address as $v)
                                    <option value="{{ $v->city_id }}">{{ $v->city_name }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>新车价格：</th>
                        <td>
                            <input type="text" class="sm" name="cars_yuanJia">万元
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是短文本长度</span>
                        </td>
                        <th>车主报价：</th>
                        <td>
                            <input type="text" class="sm" name="cars_baoJia">万元
                            <span><i class="fa fa-exclamation-circle yellow"></i>这里是默认长度</span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>强险到期：</th>
                        <td>
                            <input class="easyui-datebox" name="cars_qiangXian" data-options="formatter:myformatter,parser:myparser" required="required">
                        </td>
                        <th><i class="require">*</i>商业险到期：</th>
                        <td>
                            <input type="text" name="cars_shangYe" class="easyui-datebox" required="required" data-options="formatter:myformatter,parser:myparser">
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>年检到期：</th>
                        <td>
                            <input class="easyui-datebox" name="cars_nianJian" required="required" height="20" data-options="formatter:myformatter,parser:myparser">
                        </td>
                        <th><i class="require">*</i>状态(status)：</th>
                        <td>
                            <select name="cars_status">
                                <option value="">==请选择==</option>
                                <option value="1">上架</option>
                                <option value="0">下架</option>
                                <option value="2">已售</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="require">*</i>主图：</th>
                        <td>
                            <input id="pic_upload" type="file" name="cars_img" multiple="true">
                            <p><img id="img" title="pic" alt="上传后显示图片"></p>
                        </td>
                        <th>请添加车辆详细图片：</th>
                        <td><input type="button" class="back" onclick="addImg()" value="添加"></td>
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
                                formData.append('_token', '{{ csrf_token() }}');
                                {{-- console.log(formData);--}}
                                $.ajax({
                                    url: "/admin/cars",
                                    data: formData,
                                    /*dataType:'json',我传的不是json数据*/
                                    type: "POST",
                                    async: true,
                                    cache: false,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                        console.log(data);
                                        alert("上传成功");
                                        $('#img').attr({src:'http://oubnp8yh1.bkt.clouddn.com/'+data, width:"100"});
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
                        <td colspan="3">
                            <input type="hidden" name="cars_addTime" value="{{ time() }}">
                            <input type="submit" name="" value="提交">
                            <input type="button" class="back" onclick="history.go(-1)" value="返回">
                        </td>

                    </tr>
                </tbody>
            </table>
        </form>
    </div>

    <style>
        table.add_tab tr td span{height:22px;}
    </style>
    <script type="text/javascript">
        function myformatter(date){
            var y = date.getFullYear();
            var m = date.getMonth()+1;
            var d = date.getDate();
            return y+'-'+(m<10?('0'+m):m)+'-'+(d<10?('0'+d):d);
        }
        function myparser(s){
            if (!s) return new Date();
            var ss = (s.split('-'));
            var y = parseInt(ss[0],10);
            var m = parseInt(ss[1],10);
            var d = parseInt(ss[2],10);
            if (!isNaN(y) && !isNaN(m) && !isNaN(d)){
                return new Date(y,m-1,d);
            } else {
                return new Date();
            }
        }
        function doCheck()
        {
            var add = document.getElementById('myform');
            if (add.name.value == ''){
                alert('收货人不能为空');
                return false;
            }
            if (add.phone.value.match(/^1[34578]\d{9}$/) == null){
                alert('手机号格式不对');
                return false;
            }
            if (add.province.value == ''||add.province.value == '---请选择---'){
                alert('请选择所在地');
                return false;
            }
            if (add.city.value == ''||add.city.value == '---请选择---'){
                alert('请选择所在地');
                return false;
            }
            if (add.county.value == ''||add.county.value == '---请选择---'){
                alert('请选择所在地');
                return false;
            }
            if (add.info.value == ''){
                alert('不能为空');
                return false;
            }
            return true;
        }
    </script>
</body>
@endsection