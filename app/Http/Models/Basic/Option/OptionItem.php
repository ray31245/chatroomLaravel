<?php

namespace App\Http\Models\Basic\Option;

use Config;

use Illuminate\Database\Eloquent\Model;

class OptionItem extends Model
{
    public function __construct()
    {
        $this->setTable("basic_option_item");
    }

    public function OptionSet()
    {
        return $this->belongsTo('App\Http\Models\Basic\Option\OptionSet','option_set_id');
    }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        return $query->orderby('id', 'desc');
    }
}