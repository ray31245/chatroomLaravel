<?php

namespace App\Http\Models\Basic\Ams;

use Config;

use Illuminate\Database\Eloquent\Model;

class AmsRole extends Model
{
    public function __construct()
    {
        $this->setTable("basic_ams_role");
    }

    public function UsersData()
    {
        return $this->belongsTo('App\Http\Models\Basic\FantasyUsers','user_id')->select('id','name','mail','photo_image','account');
    }
}