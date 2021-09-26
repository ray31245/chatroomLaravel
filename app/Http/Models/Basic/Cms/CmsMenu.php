<?php

namespace App\Http\Models\Basic\Cms;

use Config;

use Illuminate\Database\Eloquent\Model;

class CmsMenu extends Model
{
    public function __construct()
    {
        $this->setTable("basic_cms_menu");
    }

    public function CmsMenu()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsMenu', 'parent_id','id')->where('is_active',1);
    }
    
    public function CmsPermission()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsPermission','cms_menu_id','id')->where('is_active',1);
    }

    public function CrsPermission()
    {
        return $this->hasMany('App\Http\Models\Basic\Crs\CrsPermission','crs_menu_id','id')->where('is_active',1);
    }

    public function CmsChild()
    {
        return $this->hasMany('App\Http\Models\Basic\Crs\CmsChild','menu_id','id');
    }

    public function CmsParent()
    {
        return $this->hasMany('App\Http\Models\Basic\Crs\CmsParent','menu_id','id');
    }

    public function WebKey()
    {
        return $this->belongsto('App\Http\Models\Basic\WebKey','key_id','id');
    }
    // CMS排序
    public function scopedoCMSSort($query)
    {
        return $query->orderby('rank', 'asc')->orderby('id', 'asc');
    }
}