/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//给分组的下拉框绑定表单值改变时的事件 onchange
$(function(){
   $("select[name=group_id]").change(function(){
//       alert($(this).val());
       var result = confirm("确定要修改用户对应的分组吗");
       if(!result){
           location.reload();
           return;
       }
       //发送ajax请求到服务器端处理
        $.ajax({
            type: "post",
            url: "/Admin/user/setGroup",
//          data:"group_id="+$(this).val()+"&uid="+$(this).attr("uid")+"&_token="+Math.random(),
            data: "group_id=" + $(this).val() + "&uid=" + $(this).attr("uid"),
            dataType: "json",
           //接受返回的数据  传过来是一对象
           success:function(result){
               alert(result.info);
               if(!result.status) location.reload();
           }
           
       });
       
   });
       
});


