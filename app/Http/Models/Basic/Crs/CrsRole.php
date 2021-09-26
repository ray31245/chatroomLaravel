<?php

namespace App\Http\Models\Basic\Crs;

use Config;

use Illuminate\Database\Eloquent\Model;

class CrsRole extends Model
{
    public function __construct()
    {
        $this->setTable("basic_crs_role");
    }

    public function CrsPermission()
    {
        return $this->hasMany('App\Http\Models\Basic\Crs\CrsPermission','crs_role_id','id')->where('is_active',1);
    }

    public function UsersData()
    {
        return $this->belongsTo('App\Http\Models\Basic\FantasyUsers','user_id')->select('id','name','mail','photo_image','account');
    }
}