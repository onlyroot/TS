@include("admin.common.header")


<div class="rleft">
    <div class="center">

      
        <div class="tableMain">
            <table  class="right-table" width="99%"  border="0px" cellpadding="0" align="center" cellspacing="0" >
                <tbody>
                    <tr ><th id="clearTDrightBorder">ID</th><th id="clearTDrightBorder">名称</th><th id="clearTDrightBorder">权限</th><th id="clearTDrightBorder">操作</th></tr>
                    @foreach($groups as $group)   
                    <tr align="center">
                        <td>{{$group->id}}</td>
                        <td>{{$group->title}}</td>
                        <td>
                            @foreach($rules as $key=>$rule)
                            @if($key % 7 ==0)<p>@endif
                            @if(in_array($rule->id,explode(",",$group->rules)))
                            <input type="checkbox"  name="rule" value="{{$rule->id}}" checked>{{$rule->title}}|
                            @else
                            <input type="checkbox" name="rule" value="{{$rule->id}}">{{$rule->title}}|
                            @endif
                            @if($key % 7 ==6)</p>@endif
                            @endforeach 
                        </td>
                        <td id="clearTDrightBorder"><a href="">编辑|</a><a  href="">删除</a></td>
                    </tr>
                    @endforeach
                </tbody> 
            </table>
         </div>

    </div>
</div>

@include("admin.common.footer")
