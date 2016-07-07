<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB, Session,Validator,Hash;
class userController extends Controller
{
    /**CommonController
     * Display a listing of the resource.
     * 显示一个资源列表
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        //查看用户信息   paginate分页  数组形式
        //权限的表关联查询  表user 关联 user_group查出user_group对应的group_id
        $users = DB::table("user")
                  ->leftJoin("user_group","user.uid","=","user_group.uid")
                  ->where("user.username","LIKE","%".$request->get("keyword")."%")
                  ->orWhere("user.nickname","LIKE","%".$request->get("keyword")."%")
                  ->orderby("user.uid","DESC")
                  -> paginate(10);
//        dd($users);
//        foreach($users as $user){
//            var_dump($user);
//        }die;
//        //分页的页码显示
//        echo ($users->render());
        //获取搜索条件
        $keyword = $request->get("keyword");
        //查询group_rule表中的所有分组   【得到结果为以数组】
        $groups = DB::table("group_rule")->get();  
//        dd($groups);
        //将数据对象发送到admin.user,index  发送的是"users" admin.user.index中存在"users"变量
        //return view("admin.user.index",compact("users"));
        return view("admin.user.index",["users"=>$users,"keyword"=>$keyword,"groups"=>$groups]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //查询所有的用户分组（管理员  超级用户  一般用户）
        $groups=DB::table("group_rule")->get();
//        return "aaaa";die;
        return view("admin.user.create",compact("groups",$groups));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //执行数据的验证
        $this->validate($request,[
            "username"=>"required|unique:user",
            "password"=>"required|between:6,15",
            "repassword"=>"required|same:password",
            "nickname"=>"required",
        ],[
            "username.required"=>"账号不能为空",
            "username.unique"=>"账号以被占用",
            "password.required"=>"密码不能为空",
            "password.between"=>"密码长度应为6-15位",
            "repassword.required"=>"确认密码必须填写",
            "repassword.same"=>"两次密码输入不一致",
            "nickname.required"=>"昵称不能为空"
        ]);
        
        //提取数据并重组
        $data = $request->except("_token","repassword","group_id");
        $data["password"]= Hash::make($data['password']);
        $data['createtime']=date("Y-m-d H-i-s");
//        dd($data);//数组
        //执行数据的创建
        if(false != $insertID = DB::table("user")->insertGetId($data)){
            //在user_group表中插入相对应的group_id
            DB::table("user_group")->insert(["uid"=>$insertID,"group_id"=>$request->get("group_id")]);
            return redirect("/Admin/user");
        }else{
            return back()->with(["info"=>"添加用户失败"]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //查询该用户的记录  返回对象
        $userRec = DB::table("user")->leftJoin("user_group","user.uid","=","user_group.uid")->where("user.uid",$id)->first();
        //查询用户对应的分组
        $groups = DB::table("group_rule")->get();
//        dd($userRec);
        return view("admin.user.edit",["userRec"=>$userRec,"groups"=>$groups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
//        dd($id);
        //验证数据的有效性
        $this->validate($request, [
            "password" => "between:6,15",
            "repassword" => "same:password",
            "nickname" => "required"
                ], [
            "password.between" => "密码长度应为6-15位",
            "repassword.same" => "两次密码输入不一致",
            "nickname.required" => "昵称不能为空"
        ]);
        //修改用户的数据
        $data = $request->except("_token", "_method", "repassword","group_id");
        $data['createtime'] = date("Y-m-d H-i-s");
        // 如果修改时修改密码 对密码重新构造
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        //返回影响的函数
        if (false !== $affectedRows = DB::table("user")->where("uid", $id)->update($data)) {
            DB::table("user_group")->where("uid",$id)->update(["group_id"=>$request->get("group_id")]);
            return redirect("/Admin/user");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
//        dd("aaaa");
        //删除用户的记录
        if(false !== DB::table("user")->where("uid",$id)->delete()){
            DB::table("user_group")->where("uid",$id)->delete();
            return redirect("/tips")->with(["info"=>"操作成功","url"=>"/Admin/user"]);
        }else{
            return redirect("/tips")->with(["info"=>"操作失败","url"=>"/Admin/user"]);
        }
    }

    //上传头像的处理地址
    public function avartar(Request $request) {
//        用json看传过来的值的类型
//        echo  json_encode($request->file());// 返回Fieldata{}对象  
//        die;
        //判断是否接收到值
        if (!$request->hasFile("Filedata")) {
            return response()->json(['status' => 0, "info" => "没有文件提交"]);
        }
//           //接受文件并转存
        $file = $request->file("Filedata");
        //重组文件名  为安全重新产生文件名
        $suffix = $file->getClientOriginalExtension(); //文件的后缀名
        $rename = date('YmdHis') . rand(1000, 9999) . "." . $suffix;

//           //转存文件
        $file->move("./uploads/avartar", $rename);
//           
//           //将存储的文件信息 写入数据库 1 通过session获取uid  Session::get("userData")->uid 通过flash传输可能被修改;
//           2 通过表单
        //修改时通过路径名加上文件名   返回json数据格式
        //第一种方法
//            $uid=(Session::get("userData")->uid);
//             DB::table("user")->where("uid",$uid)->update(["avartar"=>"/uploads/avartar/".$rename]);
        //第二种方法 
        DB::table("user")->where("uid", $request->get("uid"))->update(["avartar" => "/uploads/avartar/" . $rename]);
        //清除其他头像
//        $data = Session::get('userData')->avartar;
//        // dd($data);debug
//        $str = explode('/', $data);
//        unlink('./uploads/avartar/' . $str[3]);
        //对头像进行刷新
        $data = Session::pull("userData"); //将session中的userData取出来  然后销毁session
        $data->avartar = "/uploads/avartar/" . $rename;
        Session::put("userData", $data);
        //返回结果
        return response()->json(array("status" => 1, "info" => "/uploads/avartar/" . $rename));
    }
    
    //ajax请求修改用户分组
    public function setGroup(Request $request){
       $result=DB::table("user_group")->where("uid",$request->get("uid"))->update(["group_id"=>$request->get("group_id")]);
       if($result !==false){
           return response()->json(["status"=>1,"info"=>"修改分组成功"]);
       }else{
           return reponse()->json(["status"=>0,"info"=>"修改分组失败"]);
       }

    }

}
