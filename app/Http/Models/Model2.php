<?php

namespace App\Http\Models;

use Config;
use BaseFunction;
use Session;
use Illuminate\Database\Eloquent\Builder AS Model_Builder;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use DB;

use Illuminate\Database\Eloquent\Model;

class Model2 extends Model
{

    public function OneToMany($model,$ForeignKey,$primaryKey='')
    {
        if(empty($primaryKey))
        {
            $primaryKey='id';
        }
        return $this->hasMany(config('models.'.$model),$ForeignKey,$primaryKey);
    }

    public function OneToOne($model,$ForeignKey,$primaryKey='')
    {
        if(empty($primaryKey))
        {
            $primaryKey='id';
        }
        return $this->hasOne(config('models.'.$model),$primaryKey,$ForeignKey);
    }

    public function scopeEzexists($query, $is_pre, $existsArr,$depth=0)
    {
        // var_dump(get_object_vars($query));
        // dd($this->getTable());
        return 
            $query->whereExists(function ($query) use($depth,$is_pre, $existsArr){
                $query->select(DB::raw('id'))
                    ->when($is_pre, function ($query) use($depth,$is_pre, $existsArr) {
                        $query->when($is_pre=='123',function($query){},function($query){
                            return $query->where('is_preview', 1);
                        });
                    }, function ($query) {
                        return $query->where('is_visible', 1);
                    })
                    // 條件篩選，下次開專案記得改成多條件篩選
                    ->when(!empty($existsArr[$depth][2]),function($query) use($depth,$is_pre, $existsArr){
                        if (empty($existsArr[$depth][2][2])||$existsArr[$depth][2][2]=='where') {
                            return $query->where($existsArr[$depth][2][0],$existsArr[$depth][2][1]);
                        }elseif ($existsArr[$depth][2][2]=='whereIn') {
                            return $query->whereIn($existsArr[$depth][2][0],$existsArr[$depth][2][1]);
                        }else {
                            $existsArr['無此篩選模式'];
                            return '無此篩選模式';
                        }
                    });
                    if ($depth==0) {
                        $query->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                        ->whereRaw(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.'.$existsArr[$depth][1].' ='.$this->getTable().'.id')->take(1);
                        end($existsArr);
                        if ($depth!=key($existsArr)) {
                            $depth = $depth+1;
                            $query->whereExists(function ($query) use($depth,$is_pre, $existsArr){
                            $query->when($is_pre, function ($query) use($depth,$is_pre, $existsArr) {
                                return $query->where('is_preview', 1);
                            }, function ($query) {
                                return $query->where('is_visible', 1);
                            })
                            ->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                            ->whereRaw(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.'.$existsArr[$depth][1].' ='.Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth-1][0])::$TableName.'.id')->take(1);
                            });
                            // dd($query->tosql());
                            // $query->Ezexists($existsArr, $is_pre,$depth+1);
                        }
                    }else {
                        $query->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                        ->whereRaw(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.'.$existsArr[$depth][1].' ='.Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth-1][0])::$TableName.'.id')->take(1);
                    }
            });
    }
    public function scopeEzexists2($query, $is_pre, $existsArr,$depth=0)
    {
        // var_dump(get_object_vars($query));
        // dd($this->getTable());
        return 
            $query->whereExists(function ($query) use($depth,$is_pre, $existsArr){
                $query->select(DB::raw('id'))
                    ->when($is_pre, function ($query) use($depth,$is_pre, $existsArr) {
                        $query->when($is_pre=='123',function($query){},function($query){
                            return $query->where('is_preview', 1);
                        });
                    }, function ($query) {
                        return $query->where('is_visible', 1);
                    })
                    // 條件篩選，下次開專案記得改成多條件篩選
                    ->when(!empty($existsArr[$depth][2]),function($query) use($depth,$is_pre, $existsArr){
                        if (empty($existsArr[$depth][2][2])||$existsArr[$depth][2][2]=='where') {
                            return $query->where($existsArr[$depth][2][0],$existsArr[$depth][2][1]);
                        }elseif ($existsArr[$depth][2][2]=='whereIn') {
                            return $query->whereIn($existsArr[$depth][2][0],$existsArr[$depth][2][1]);
                        }else {
                            $existsArr['無此篩選模式'];
                            return '無此篩選模式';
                        }
                    });
                    if ($depth==0) {
                        $query->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                        ->whereRaw($this->getTable().'.'.$existsArr[$depth][1].' ='.Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.id')->take(1);
                        end($existsArr);
                        if ($depth!=key($existsArr)) {
                            $depth = $depth+1;
                            $query->whereExists(function ($query) use($depth,$is_pre, $existsArr){
                            $query->when($is_pre, function ($query) use($depth,$is_pre, $existsArr) {
                                return $query->where('is_preview', 1);
                            }, function ($query) {
                                return $query->where('is_visible', 1);
                            })
                            ->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                            ->whereRaw(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth-1][0])::$TableName.'.'.$existsArr[$depth][1].' ='.Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.id')->take(1);
                            });
                            // dd($query->tosql());
                            // $query->Ezexists($existsArr, $is_pre,$depth+1);
                        }
                    }else {
                        $query->from(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName)
                        ->whereRaw(Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth][0])::$TableName.'.'.$existsArr[$depth][1].' ='.Config::get('app.dataBasePrefix').config('models.'.$existsArr[$depth-1][0])::$TableName.'.id')->take(1);
                    }
            });
    }

    // CMS排序
    public function scopedoCMSSort($query)
    {
        // return $query->orderby('id', 'desc')->orderby('rank', 'asc');
        return $query->orderby('created_at', 'desc')/*->orderby('rank', 'asc')*/;
    }  
    // 排序
    public function scopedoSort($query)
    {
        return $query->orderby('rank', 'asc')->orderby('id', 'asc');
    }
    // 取得該分館可見資料
    public function scopeisVisible($query, $is_pre)
    {
        if($is_pre==1){
            return $query->where('is_preview', 1);
        }else{
            return $query->where('is_visible', 1)/*->where('is_reviewed', 1)*/;
        }
    }
    // 寫入 新增/修改 log
    protected function performUpdate(Model_Builder $query){

        $dirty = $this->getDirty();

        if (count($dirty) > 0) {            
            // 寫入修改紀錄
            if(!$this->attributes['create_id']){
                $this->setAttribute('create_id', Session::get('fantasy_user.id'));
                BaseFunction::writeLogData('insert', ['table'=>$this->table, 'id'=>$this->attributes['id']]);
            }
            else BaseFunction::writeLogData('edit', ['table'=>$this->table, 'id'=>$this->attributes['id']]);
        }
        return parent::performUpdate($query);
    }
    public function save(array $attributes = [], array $options = []){
        // dd('save');
        
        $dirty = $this->getDirty();

        if (count($dirty) > 0) {
            if (array_key_exists('url_title',$this->attributes)&&empty($this->attributes['url_title'])) {
                if (empty($this->original['url_title'])) {
                    self::unique_url_title();
                }else {
                    $this->attributes['url_title'] = $this->original['url_title'];
                }
            }
            if(array_key_exists('create_id',$this->attributes)&&!$this->attributes['create_id'])
            {
                self::unique_url_title();
            }
        }            
        return parent::save($attributes, $options);
    }

    public function replicate(array $except = null)
    {
        self::unique_url_title();
        return parent::replicate($except);
    }

    public function unique_url_title()
    {
        if (array_key_exists('url_title',$this->attributes)) {
            $randomWord =  Str::random(6);
            if(empty($this->attributes['url_title']))
            {
                $this->setAttribute('url_title', 'default_url'.$randomWord);
            }else{
                $rule = [
                            'url_title' => 'unique:'.$this->table,
                        ];
                $validator = Validator::make($this->attributes, $rule);
                if ($validator->fails())
                {
                    $errors = $validator->errors();
                    if ($errors->has('url_title')) {
                        $this->setAttribute('url_title', $this->attributes['url_title'].$randomWord);
                    }
                }
            }
        }
    }
}