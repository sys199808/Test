<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/x-icon" href="/favicon.ico">
    <link rel="stylesheet" href="/admin/style/css/ch-ui.admin.css">
    <link rel="stylesheet" href="/admin/style/font/css/font-awesome.min.css">
    <script type="text/javascript" src="/admin/style/js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="/admin/style/js/jquery.js"></script>
    <script type="text/javascript" src="/admin/style/js/ch-ui.admin.js"></script>
    <script type="text/javascript" src="/layer/layer.js"></script>
    <link rel="stylesheet" type="text/css" href="/jquery-easyui-1.5.2/themes/default/easyui.css">
    <link rel="stylesheet" type="text/css" href="/jquery-easyui-1.5.2/themes/icon.css">
    <script type="text/javascript" src="/jquery-easyui-1.5.2/jquery.min.js"></script>
    <script type="text/javascript" src="/jquery-easyui-1.5.2/jquery.easyui.min.js"></script>
</head>
@section('content')


@show
</html>