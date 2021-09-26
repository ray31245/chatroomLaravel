<?php

namespace App\Http\Models\Basic\Branch;

use Config;

use Illuminate\Database\Eloquent\Model;

class BranchOrigin extends Model
{
    public function __construct()
    {
        $this->setTable("basic_branch_origin");
    }

    public function BranchOriginUnit()
    {
        return $this->hasMany('App\Http\Models\Basic\Branch\BranchOriginUnit','origin_id','id')->where('is_active',1);
    }
}