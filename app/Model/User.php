<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //表名
    protected $table = 'users';
    //主键字段
    protected $primaryKey = 'id';
    //主键类型是字符串，不是int
//    protected $keyType = 'string';
    //主键不自增
//    public $incrementing = false;
    //取消默认updated_at, created_at
    public $timestamps = false;

    protected $guarded = [];

}
