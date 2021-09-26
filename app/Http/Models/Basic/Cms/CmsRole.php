<?php

namespace App\Http\Models\Basic\Cms;

use Config;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;
use App\Http\Models\Basic\Cms\CmsPermission;

class CmsRole extends Model
{
    public function __construct()
    {
        $this->setTable("basic_cms_role");
    }

    public function CmsPermission()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsPermission','cms_role_id','id')->where('is_active',1);
    }

    public function CmsPermissionWithMenu()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsPermission','cms_role_id','id')->where('is_active',1)->with('CmsMenu');
    }
    public function BranchOriginUnit()
    {
        return $this->belongsTo('App\Http\Models\Basic\Branch\BranchOriginUnit', 'branch_id', 'id')->where('is_active', 1);
    }
    public function UsersData()
    {
        return $this->belongsTo('App\Http\Models\Basic\FantasyUsers','user_id')->select('id','name','mail','photo_image','account');
    }

    protected function performInsert(Model_Builder $query)
    {
        $result = parent::performInsert($query);
        if($result==true){
            // 新增CmsPermission
            $data = new CmsPermission();
            $data->is_active = '1';
            $data->cms_role_id = $this->id;
            $data->cms_menu_id = '1';
            $data->is_edit = '1';
            $data->is_add = '1';
            $data->is_delete = '1';
            $data->created_at = date('Y-m-d H:i:s');
            $data->updated_at = date('Y-m-d H:i:s');
            $data->save();
        }
        return $result;
    }
    public function CmsDataAuth()
    {
        return $this->hasMany('App\Http\Models\Basic\Cms\CmsDataAuth', 'cms_role_id', 'id');
    }
}