<!DOCTYPE html>
<html xmlns="">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CMS后台管理-登录</title>
        <link href="/img/loginfavicon.ico" rel="shortcut icon"/>
        <link href="/css/admin/share1.css" rel="stylesheet" type="text/css"/>
        <link href="/css/admin/login.css" rel="stylesheet" type="text/css"  />
        <link href="/css/admin/share.css" rel="stylesheet" type="text/css"  />
        <!--<script src="/js/admin/login_index.js"></script>-->
        
        <style>
            #img{
                position:relative;
                top:11px;
                height:35px;
                margin:-13px 0 0 3px;
            }
        </style>
    </head>

    <body id="loginBody">
        <div id="pointerOpen" onclick="hideLoginBezel()">开启登录</div>
        <div id="loginBezel">
            <div id="loginChildTop">　<img src="/img/logo-right.png" width="57" height="50" align="absbottom"  /> CMS管理平台</div>
            <div id="loginChildBottom"> 
                <table cellpadding="0" cellspacing="0" width="100%" height="95%" border="0">
                    <tr> <form action="/Admin/login/logTodo" method="post" name="login" ></tr>
                        <tr><input type="hidden" name="_token" value="{{$data["_token"] or csrf_token()}}"></tr>
                        <tr>
                            <td align="right" width="35%">账　号：</td>
                            <td align="left" width="65%"><input type="text" id="account"  class="inputUP"  name="username" placeholder="username"/></td>
                        </tr>
                        <tr>
                            <td align="right">密　码：</td>
                            <td align="left"><input type="password" id="pwd" class="inputUP" name="password"  placeholder="password"/></td>
                        </tr>
                       <tr>
                            <td align="right">验证码：</td>
                            <td align="left"> <input  type="text" id="checkNum" name="code"  placeholder="Code"  value=""  style="width:115px;"  ><img   id="img" src="{{url('/Admin/login/Captcha').'/'. rand()}}" onclick="this.src = this.src.replace('/\d+$/', '') + Math.random()"></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><input type="submit" onclick="toLogin(this)"  id="toLogin" value="登　录"/> </td>
                        </tr> 
                        <tr> </form></tr>
                </table>
                <div align="center"  style="float:left;color:red;margin:0 0 0 205px;"  >
                    {{ session("info") }}
                    <ul>
                        @if(count($errors)>0)
                        @foreach($errors->all() as $e)
                        <li>{{$e}}</li>
                        @endforeach
                        @endif
                    </ul>
                </div>


            </div>
        </div>
        <script src="/js/admin/login.js" type="text/javascript"></script>
        <script src="/js/admin/jquery-1.11.0.js" type="text/javascript" ></script>
       
        

        <div style="text-align:center;">
            <p><a href="" target="_blank"></a></p>
        </div>
    </body>
</html>