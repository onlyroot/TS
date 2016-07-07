<?php

namespace App\Http\Middleware;

use Closure;
use Session,
    DB;

class CommonMiddleware {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
//        dd($_SERVER["REQUEST_URI"]);/Admin/login  当前的路由
        //验证登录状态  如果没有登录跳转到登陆页 其中要去除登陆页
//        if (!Session::has("userData")) {
//            return redirect("/Admin/login");
//        }
//        preg_match()执行一个正则表达式的匹配
        if (!Session::has("userData") && !preg_match("/^\/Admin\/login/", $_SERVER['REQUEST_URI'])) {
            return redirect("/Admin/login");
        } else {
            //查找所有的权限列表 判断当前的操作是否需要权限验证
            $result = DB::table("rule")->get();
//            dd($result);//数组对象的形式  将其变为二维数组的形式["/Admin/user"=>"查看用户]
            $rules = array();
            foreach ($result as $tmp) {
                $rules[$tmp->name] = $tmp->title;
            }
//            dd($rules);//一维数组的形式
//            dd($_SERVER); //  /Admin/user
            //去除路由后面的参数(以？开始后面链接多个字符 )
            //以问号开头后面连上多个字符  preg_replace($p,$r,$s)执行一个正则表达式的搜索和替换  搜索s中的p部分用r替换
            $subject = preg_replace("/^\?.+$/", "", $_SERVER['REQUEST_URI']);
            //去除中间的数字 /Admin/7/edit
            $subject = preg_replace("/\/\d+/", "", $subject);
//            dd($subject); //  /Admin/user
            if (array_key_exists($subject, $rules)) {
                //获取当前用户的分组 group_id
                $group_id = DB::table("user")->leftJoin("user_group", "user.uid", "=", "user_group.uid")->where("user.uid", Session::get("userData")->uid)->pluck("user_group.group_id");
                //由分组查询权限集合(1,2,3,4)
                $lists = DB::table("group_rule")->where("id", $group_id)->pluck("rules");
                //当前操作权限的id  1
                $rule = DB::table("rule")->where("name", $subject)->pluck("id");
//                dd($lists);
                if (!in_array($rule, explode(",", $lists))) {
//                    dd($_SERVER);
                    //  "HTTP_REFERER" => "http://www.mylaravel.com/Admin/user"
                    return redirect("/tips")->with(["info" => "你无权" . $rules[$subject], "url" => $_SERVER['HTTP_REFERER']]);
                }
            }
        }
        return $next($request);
    }

}
