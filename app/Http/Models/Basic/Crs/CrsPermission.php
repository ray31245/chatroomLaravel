<?php

namespace App\Http\Models\Basic\Crs;

use Config;

use Illuminate\Database\Eloquent\Model;

class CrsPermission extends Model
{
    public function __construct()
    {
        $this->setTable("basic_crs_permission");
    }

    public function CrsRole()
    {
        return $this->belongsTo('App\Http\Models\Basic\Crs\CrsRole','crs_role_id');
    }

    public function CmsMenu()
    {
        return $this->belongsTo('App\Http\Models\Basic\Cms\CmsMenu','cms_menu_id');
    }

}