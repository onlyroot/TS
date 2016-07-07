@include("admin.common.header")
<script src="{{asset('/plugins/uploadify/jquery.uploadify.min.js')}}" ></script>
<link type="text/css" rel="stylesheet" href="{{asset('/plugins/uploadify/uploadify.css')}}">
<!--主体内容-->
<div id="showHideMenu"><div></div></div> 
<div class="rleft">
    <div class="center">

        <div class="tableMain">
            <table class="right-table" width="300px"  border="0px" cellpadding="0" align="center" cellspacing="0" style="float:left;">
                <tbody>
                    <tr >
                        <th>头像</th>
                        <th>信息</th>
                    </tr>
                    <tr>
                        <td rowspan="4"> <div class="fl img" ><img src="{{Session::get("userData")->avartar}}" width=120;  id="im"></div></td>
                        <td>账号：{{Session::get("userData")->username}}</td>
                    </tr>
                    <tr >
                        <td>昵称：{{Session::get("userData")->nickname}}</td>
                    </tr>
                    <tr >
                        <td>性别：{{Session::get("userData")->sex}}</td>
                    </tr>
                    <tr >
                        <td>创建：{{Session::get("userData")->createtime}}</td>
                         <!--<td id="clearTDrightBorder">修改　预览</td>-->
                    </tr>
                </tbody> 
            </table>
        
        <form name="fm">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="uid" value="{{Session::get('userData')->uid}}">
            <p style="margin:225px 0 0 5px;"><input type="file" name="avartar" id="avartar" ></p>
        </form>

        <script src="{{asset('/js/admin/index.js')}}"></script>
        </div>
    </div>
</div>


@include("admin.common.footer")