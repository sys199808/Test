<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
//    连接数据库表
    protected $table = 'admin_roles';
//    主键
    protected $primaryKey = 'role_id';
//    时间戳
    public $timestamps = false;
//    白名单
//    public $fillable = ['post'];
//    黑名单
    protected $guarded = [];
}
