<?php

namespace App\Http\Models\Basic\Fms;

use Config;

use Illuminate\Database\Eloquent\Model;

class FmsZero extends Model
{
    public function __construct()
    {
        $this->setTable("basic_fms_zero");
    }

    public function FmsFirst()
    {
        return $this->hasMany('App\Http\Models\Basic\Fms\FmsFirst','zero_id','id')->where('is_active',1);
    }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        return $query->orderby('id', 'desc');
    }

}