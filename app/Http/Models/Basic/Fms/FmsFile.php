<?php

namespace App\Http\Models\Basic\Fms;

use Config;
use Storage;

use Illuminate\Database\Eloquent\Model;

class FmsFile extends Model
{
    public function __construct()
    {
        $this->setTable("basic_fms_file");
    }

    public function FmsFirst()
    {
        return $this->belongsTo('App\Http\Models\Basic\Fms\FmsFirst','first_id');
    }

    public function FmsSecond() 
    {
        return $this->belongsTo('App\Http\Models\Basic\Fms\FmsSecond','second_id');
    }

    public function FmsThird()
    {
        return $this->belongsTo('App\Http\Models\Basic\Fms\FmsThird','third_id');
    }

    // 刪除資料時順便刪除檔案
    // public function delete(){

    //     // 刪除檔案
    //     $trueSrc = str_replace('/upload/','',$this->attributes['real_route']);
    //     if (Storage::disk('localPublic')->exists($trueSrc)) Storage::disk('localPublic')->delete($trueSrc);

    //     // 刪除縮圖檔案
    //     if(array_key_exists('real_m_route', $this->attributes)){
    //         $true_m_Src = str_replace('/upload/','',$this->attributes['real_m_route']);
    //         if (Storage::disk('localPublic')->exists($true_m_Src)) Storage::disk('localPublic')->delete($true_m_Src);
    //     }
    //     return parent::delete();
    // }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        return $query->orderby('id', 'desc');
    }
}