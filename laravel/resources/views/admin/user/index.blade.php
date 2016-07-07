
@include("admin.common.header")


<link type="text/css" rel="stylesheet" href="{{asset('/bootstrap/css/bootstrap.css')}}" />
<div class="rleft">
    <div class="center">

        <div class="search">
            <form>
                <span><input type="hidden" name="_token" value="{{csrf_token()}}"></span>
                <span>关键字：<input  style="color:gray" type="text" name="keyword" value="{{$keyword}}" placeholder="请输入账号和昵称"/></span>
                <span><input type="submit" id="search-btn" value="查询" /> </span>
            </form>
        </div>
        <div class="tableMain">
            <table  class="right-table" width="99%"  border="0px" cellpadding="0" align="center" cellspacing="0" >
                <tbody>
                    <tr ><th id="clearTDrightBorder">ID</th><th id="clearTDrightBorder">账号</th><th id="clearTDrightBorder">昵称</th><th id="clearTDrightBorder">性别</th><th id="clearTDrightBorder">创建时间</th><th id="clearTDrightBorder">所属分组</th><th id="clearTDrightBorder">操作</th></tr>
                    @foreach($users as $user)   
                    <tr align="center">
                        <td>{{$user->uid}}</td>
                        <td>{{$user->username}}</td>
                        <td>{{$user->nickname}}</td>
                        <td>{{$user->sex}}</td>
                        <td>{{$user->createtime}}</td>
                        <td>
                            <select style="color:gray" name="group_id" uid="{{$user->uid}}" >
                            @foreach($groups as $group)
                            @if($user->group_id == $group->id)
                            <option value="{{$group->id}}" selected>{{$group->title}}</option>
                            @else
                            <option value="{{$group->id}}">{{$group->title}}</option>
                            @endif
                            @endforeach
                            </select>
                        </td>
                        <td id="clearTDrightBorder"><a href="{{url('/Admin/user/'.$user->uid.'/edit')}}">编辑|</a><a  href="{{url('/Admin/user/delete/'.$user->uid)}}">删除</a></td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
         </div>
    <p>
	<!--{!!$users->render()!!}-->
        <!--解决查找过程中出现的查找后分页显示错误的问题-->
        {!!$users->appends(['keyword'=>$keyword])->render()!!}
    </p>
    </div>
</div>
<script src="/js/admin/user_index.js"></script>
@include("admin.common.footer");