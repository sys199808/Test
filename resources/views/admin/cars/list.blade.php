@extends('layouts.admin')
@section('content')
<body>
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{ url('admin/index') }}" target="_parent">首页</a> &raquo; <a href="#">商品管理</a> &raquo; 商品列表
    </div>
    <!--面包屑导航 结束-->

	<!--结果页快捷搜索框 开始-->
	<div class="search_wrap">
        <form action="{{url('admin/user')}}" method="get">
            <table class="search_tab">
                <tr>
                    <th width="70">关键字:</th>
                    <td><input type="text" name="keywords" value="{{isset($keyword)?$keyword:''}}" placeholder="关键字"></td>
                    <td><input type="submit"  value="查询"></td>
                </tr>
            </table>
        </form>
    </div>
    <!--结果页快捷搜索框 结束-->

    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{ url('admin/cars/create') }}"><i class="fa fa-plus"></i>新增商品</a>
                    <a href="#"><i class="fa fa-recycle"></i>批量删除</a>
                    <a href="#"><i class="fa fa-refresh"></i>更新排序</a>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab">
                    <tr>

                        <th class="tc">ID</th>
                        <th>用户名</th>
                        <th>用户电话</th>
                        <th>车辆详情</th>
                        <th>更新时间</th>
                        <th>汽车主图</th>
                        {{--1上架 0下架 2已售--}}
                        <th>状态</th>
                        <th>操作</th>
                    </tr>
                    @foreach($cars as $k=>$v)
                    <tr>
                        <td class="tc">{{ $v->cars_id }}</td>
                        <td>{{ $v->user_name }}</td>
                        <td><a href="#">{{ $v->user_phone }}</a></td>
                        <td>
                            <a href="#">details</a>
                        </td>
                        <td>{{ date('Y-m-d H:i:s',$v->cars_addTime) }}</td>
                        <td><img src="/" title="主图" alt="" width="80"></td>
                        <td>
                            @if($v->cars_status == 1)
                                <button>上架</button>
                            @elseif($v->cars_status ==0)
                                <button>下架</button>
                            @else
                            <button>已售</button>
                            @endif
                        </td>
                        <td>
                            <a href="">修改</a>
                            <a href="javascript:void(0)" onclick="delUser({{ $v->cars_id }})">删除</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
                <script>
                    function delUser(id){
//                  参数1 要请求的服务器路由
//                  参数2 请求要携带的参数数据  _method：delete  _token
//                  参数3 回调函数,回调函数的参数data表示服务器返回的数据
//                  $.post(URL,data,callback);
//                  询问框
                    layer.confirm('确认删除吗？', {
                        btn: ['确定','取消'] //按钮
                        }, function(){
//                  layer.msg('删除成功', {icon: 1});
                            $.post("{{url('admin/cars/')}}/"+id,{'_method':'delete','_token':'{{ csrf_token() }}'},function(data){
//                                console.log(data);
                                if(data.status != 0){
                                    location.href = location.href;
                                    layer.msg('删除成功！！！', {icon: 6});
                                }else{
                                    location.href = location.href;
                                    layer.msg('删除失败。。。', {icon: 5});
                                }
                            });
                        }, function(){

                        });
                    }
                </script>

                {{--<div class="page_list">
                    {!! $cars->appends(['keywords' => $keyword])->render() !!}
                </div>--}}
                <style>
                    .result_content ul li span{color:red;}
                </style>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->
</body>
@endsection