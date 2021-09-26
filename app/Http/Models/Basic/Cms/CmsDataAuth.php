<?php

namespace App\Http\Models\Basic\Cms;

use Config;

use Illuminate\Database\Eloquent\Model;

class CmsDataAuth extends Model
{
    protected $table = 'basic_cms_data_auth';
    public $timestamps = false;

    public function CmsRole()
    {
        return $this->belongsTo('App\Http\Models\Basic\Cms\CmsRole', 'cms_role_id', 'id');
    }
}

