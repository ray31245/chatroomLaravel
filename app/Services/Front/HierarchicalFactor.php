<?php
namespace App\Services\Front;
use DB;
use config;
Class HierarchicalFactor
{
	protected static $is_pre;
    public function __construct($modelstruct)
    {
        $this->modelstruct = $modelstruct;
        foreach ($this->modelstruct as $key => $value) {
            // page
            if (empty($value[1])) {
                $this->modelstruct[$key][1] = 'parent_id';
            }
            // page
            if (empty($value[2])) {
                $this->modelstruct[$key][2] = '';
            }
            // 預設單選
            if (empty($value[3])) {
                $this->modelstruct[$key][3] = 'single';
            }
            // 預覽站
            self::$is_pre = preg_match("/preview./",$_SERVER['HTTP_HOST']) ? 1 : 0;
        }
    }
    // 預定做成自動篩選出父層與子層都有內容的功能但是(尚未完成)
    public function get_Item($depth=0,$paginate=false,$queryArr=[])
    {
        $result = config('models.'.$this->modelstruct[$depth][0])::isVisible(self::$is_pre)->doSort();
        foreach ($this->modelstruct as $key => $value) {
            if ($key>$depth) {
                $result->whereExists(function ($query) use($key,$depth){
                    $query->select(DB::raw('id'))
                        ->when(self::$is_pre, function ($query) use($key,$depth) {
                            return $query->where('is_preview', 1);
                        }, function ($query) {
                            return $query->where('is_visible', 1);
                        })
                        ->from(Config::get('app.dataBasePrefix').config('models.'.$this->modelstruct[$key][0])::$TableName)
                        ->whereRaw(Config::get('app.dataBasePrefix')
                        .config('models.'.$this->modelstruct[$key][0])::$TableName.
                        '.'.$this->modelstruct[$key][1].' ='.Config::get('app.dataBasePrefix')
                        .config('models.'.$this->modelstruct[$depth][0])::
                        $TableName.'.id')
                        ->take(1)
                        ;
                });
            }
        }
        $result = $result->get();
        return $result;
    }
    // public static function Ezexists()
    // {

    // }
    public function move()
    {
        echo '跑';
    }
 
    public function sleep()
    {
        echo '睡';
    }
}
class Bird
{
 
    public function move()
    {
        echo '飛';
    }
 
    public function sleep()
    {
        echo '睡';
    }
}
 
//實作Dog類別
$dog = new Dog();
//實作Bird類別
$bird = new Bird();
 
$dog->move(); //跑
$bird->move(); //飛