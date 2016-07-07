/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(function() {
    $("#avartar").uploadify({
        //flash上传程序的脚本文件
        swf: "/plugins/uploadify/uploadify.swf",
        //设置按钮样式
        buttonText: "点击上传",
        buttonImage: "/plugins/uploadify/ImgBtn.png",
        width: 50,
        height: 23,
        //上传要求的控制
//        fileTypeDesc: "选择图片",
        fileTypeExts: "*.jpg;*.jpeg;*.png;*.gif",
        fileSizeLimit: 5 * 1024 * 1024,
//        随表单一起提交的数据
        formData: {
            _token: document.fm._token.value,
            uid: document.fm.uid.value,
        },
        //提交处理
        method: "post",
        uploader: "/Admin/user/avartar",
        //php页面处理结果返回值
        onUploadSuccess: function(file, txt, response) {
//            alert(txt);die; // 返回值txt为一个对象  Filedata
            eval("var result =" + txt);//将对象赋给result
            if (!result.status) {
                alert(result.info);
            } else {
//             alert(result.info);
                $("#im").attr("src", result.info);
            }
        }
//        
    });
//    

});
