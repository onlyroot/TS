<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'think_admin_user';//表名、
    protected $primaryKey = "uid";//使用find查找 系统默认为id  修改系统主键为uid
    public $timestamps = false;//关闭时间的自动更新
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = ['name', 'email', 'password'];//自动填充字段
      protected $guarded = [];//不可自动转换的字段(所有字段均可填充但不是自动) [gɑːd]
        
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['avartar', 'sex'];//隐藏字段
    
    
    //读取数据的方法
    public function read(){
        //读取所有的数据findAll()
        return $this->all();
        //读取一条数据的方法 //系统默认主键为id  单表中的主键为uid 需要设置主键
//        return $this->find(1);//结果为uid=1
        //连贯操作的get方法
//        return $this->where("uname","iii")->get(); //显示为空 表中不存在uname为iii的用户
//        return $this->where("uname","tom")->get();
        //带条件连接符   $this继承的Model类 get方法为Model类中的方法
//        return $this->where("uid","<",30)->get();
       
    }
    
    //添加数据
    public function userAdd(){
        //设置数据值
//        $this->uname="xiaodong";
//        $this->password=md5(rand(1,100));
//        $this->nickname="wonderful";
//        
//        //如果已有准备好的数据
        $data = array("uname"=>"xiaolan","password"=>md5(rand(1,100)),"nickname"=>"wish");
        $this->fill($data);
        
        //将数据保存 框架中默认增加时间自动更新的字段 需关闭  添加操作什么都不返回
        $this->save();
    }
    
    //修改数据
    public function userUpdate(){
        //设置要修改的记录
        $user = $this->find(45);
        //设置新的数据值
        $user ->uname= "xiaoxi";
        $user->nickname="fanfan";
        //保存新的数据
        $user->save();
        
        //批量修改数据  调用update方法  
//        $user = $this->where("uid",">",44);
//        $user ->update(["uname"=>"cc","nickname"=>"zz"]);
        $this->where("uid",">",44)->update(["uname"=>"CC","nickname"=>"zZZ"]);
        
    }
    
    //删除数据
    public function userDel(){
        //查找要删除的记录
        $user = $this->findOrFail(31);
         return $user->delete();
    }
    
    
    
}
