<?php

namespace App\Http\Models\Basic\Cms;

use Config;

use Illuminate\Database\Eloquent\Model;

class CmsChildSon extends Model
{
    public function __construct()
    {
        $this->setTable("basic_cms_child_son");
    }

    public function CmsChild()
    {
        return $this->belongsTo('App\Http\Models\Basic\Cms\CmsChild','child_id');
    }

}