<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CMS后台管理平台-首页</title>
<link href="/img/favicon.ico" rel="shortcut icon"/>
<link rel="stylesheet" type="text/css" href="/css/admin/share1.css"/>
<link rel="stylesheet" type="text/css" href="/css/admin/index.css"/>
<link rel="stylesheet" type="text/css" href="/css/admin/share.css"/>
<script src="/js/admin/jquery-1.11.0.min.js" type="application/javascript"></script>
<script  src="/js/admin/jsUtil.js" type="text/javascript"></script>
<script src="/js/admin/index1.js" type="application/javascript"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />
<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>

</head>

<body>
    <!--头部-->
<div class="bezel" id="bezel-id">
    <div class="head">
        <div class="hleft"><span class="head-icon">ONLY ONE管理平台</span></div>
        <div class="hcenter">
        	<ul>
            	<li class="on">站点管理</li>
            	<li>内容管理</li>
            	<li>业务管理</li>
            	<li>系统管理</li>
            </ul>
        </div>
        <div class="hright">
        	<span>管理员：{{Session::get("userData")->nickname}} 您好，欢迎登录使用！ <a class="outLogin" href="{{url('/Admin')}}">个人中心</a>　<a class="outLogin" href="{{url('/Admin/login/logout')}}">退出</a></span>
        </div>
    </div>
    <!--左侧栏-->
    <div class="center">
        <div class="cleft" id="cleft-id">	
            <h4 class="on">系统管理</h4>
            <ul style="display:block;">
            	<li class="on"><a href="{{url('/Admin')}}" >用户信息</a></li>
            	<li><a href="{{url('/Admin/user')}}" >用户列表</a></li>
                <li><a href="{{url("/Admin/user/create")}}">添加用户</a></li>
            	<li><a href="{{url("/Admin/group")}}">权限管理</a></li>
            </ul>
            <h4>内容管理</h4>
            <ul>
            	<li class="on"><a href="javascript:void(0)">角色管理</a></li>
            	<li><a href="">用户列表</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            	<li><a href="javascript:void(0)">用户管理</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            	<li><a href="javascript:void(0)">用户管理</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            	<li><a href="javascript:void(0)">用户管理</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            	<li><a href="javascript:void(0)">用户管理</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            	<li><a href="javascript:void(0)">用户管理</a></li>
            	<li><a href="javascript:void(0)">权限管理</a></li>
            </ul>
            <h4>业务管理</h4>
            <h4>站点管理</h4>
        </div>

