<?php

namespace App\Http\Models\Basic;

use Config;

use Illuminate\Database\Eloquent\Model;

class WebKey extends Model
{
    public function __construct()
    {
        $this->setTable("basic_web_key");
    }

    public function CmsMenu()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsMenu','key_id','id');
    }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        return $query->orderby('rank', 'asc')->orderby('id', 'asc');
    }
}