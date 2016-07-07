
@include("admin.common.header")

<div id="showHideMenu"><div></div></div> 
<div class="rleft">
    <div class="center">

        <div class="tableMain">
            <table class="right-table" width="350px"  border="0px" cellpadding="0" align="center" cellspacing="0" style="margin:10px 0 0 10px;float:left">
                <tbody>
                    <tr> <form method="post" action="/Admin/user/{{$userRec->uid}}"  ></tr>
                    <tr >
                        <link type="text/css" rel="stylesheet" href="{{asset('/css/admin/user_add.css')}}" />
                        <a href="{{url("/Admin/user")}}"><<返回</a>
                        <hr>
                    </tr>
                    <tr>
                     <!--为什么没有传过来token-->
                    <input type="hidden" name="_token" value="{{ csrf_token()}}">
                    <input type='hidden' name='_method' value='PUT'>
                    </tr>
                    <tr >
                        <td><p>&nbsp&nbsp账 号: <input type="text" name="username" value="{{$userRec->username}}" disabled></p></td>
                    </tr>
                    <tr >
                        <td><p>&nbsp&nbsp昵 称: <input type="text" name="nickname" value="{{$userRec->nickname}}"></p></td>
                    </tr>
                    <tr >
                        <td> <p>&nbsp&nbsp密 码: <input type="password" name="password" value="">(*置空则不修改*)</p></td>
                    </tr>
                    <tr >
                        <td> <p>&nbsp&nbsp确 认: <input type="password" name="repassword" value="">(*和密码一致*)</p></td>
                    </tr>
                     <tr >
                        <td><p>&nbsp&nbsp性 别: <input type="radio" name="sex" value="男" @if($userRec->sex =='男') checked @endif><label for="male">男</label>
                        <input type="radio" name="sex" value="女" @if($userRec->sex=='女') checked @endif><label for="female">女</label> </p></td>
                     </tr>
                    <tr >
                        <td> <p>&nbsp&nbsp分 组:
                                <select name="group_id">
                                    @foreach($groups as $group)
                                    @if($group->id == $userRec->group_id)
                                    <option value="{{$group->id}}" selected>{{$group->title}}</option>
                                    @else
                                    <option value="{{$group->id}}">{{$group->title}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </p>
                        </td>
                    </tr>
                     <tr >
                        <td><p>&nbsp&nbsp<input type="submit" value="保存"</p></p></td>
                    </tr>
                    <tr> </form></tr>
                </tbody> 
            </table>
            <div style="float:left">
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
</div>

@include("admin.common.footer")