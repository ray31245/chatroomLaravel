<?php

namespace App\Http\Controllers\Fantasy;

use Illuminate\Routing\Controller as BaseController;

use BaseFunction;
use Config;
use View;
use Illuminate\Support\Str;

class MakeUnit extends BackendController
{

    public static function textInput($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '單行輸入，內容不支援HTML及CSS、JQ、JS等語法，特殊符號如 : @#$%?/\|*.及全形也盡量避免。';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';
        $search_field = (!empty($set['name'])) ? $set['name'] : ''; //要搜尋的欄位

        $html =  View::make('Fantasy.cms.includes.template.textInput', [
            'search' => $search,
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled,
            'search_field' => $search_field,
            'set' => $set,
        ])->render();

        echo ($html);
    }
    /*編輯區塊*/
    public static function textArea($set = [])
    {
        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '可輸入多行文字，內容不支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter，<br>輸入區域可拖曳右下角縮放，若欲於文字間穿插超連結，請直接寫入 html 語法。';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        $html =  View::make('Fantasy.cms.includes.template.textArea', [
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled,
            'set' => $set,
        ])->render();

        echo ($html);
    }

    /*號碼輸入*/
    public static function numberInput($set = [])
    {
        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        $html =  View::make('Fantasy.cms.includes.template.numberInput', [
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled,
            'set' => $set,
        ])->render();

        echo ($html);
    }
    /*狀態*/
    public static function radio_btn($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 是否為sontable新增用模版
        $set['sontable_add'] = (!empty($set['sontable_add'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        // 是否disabled
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        // 若為搜尋用，要搜尋的欄位(目前直接用name的欄位)
        $search_field = (!empty($set['name'])) ? $set['name'] : ''; //要搜尋的欄位

        $view = View::make(
            'Fantasy.cms.includes.template.radio_btn',
            [
                'search' => $search,
                'sontable' => $sontable,
                'name' => $name,
                'title' => $title,
                'tip' => $tip,
                'value' => $value,
                'disabled' => $disabled,
                'search_field' => $search_field,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /*審核功能*/
    public static function reviewed_radio_btn($set = [])
    {
        $name = (!empty($set['name'])) ? $set['name'] : '';
        if ($set['need_review'] != '1') return; //此功能不需審核

        $title = '發佈審核';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        $html =  View::make('Fantasy.cms.includes.template.reviewed_radio_btn', [
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'set' => $set,
        ])->render();

        echo ($html);
    }
    /*單選*/
    public static function select($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $explanation = (!empty($set['explanation'])) ? $set['explanation'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        //是否可以不選
        $empty = (!empty($set['empty'])) ? $set['empty'] : 'no';

        //選項
        $options = (!empty($set['options'])) ? $set['options'] : [];
        // 是否disabled
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        //關聯式下拉選單用
        $options_group_set = (!empty($set['options_group_set'])) ? $set['options_group_set'] : 'no';
        $options_group = (!empty($set['options_group'])) ? $set['options_group'] : [];

        // 若為搜尋用，要搜尋的欄位(目前直接用name的欄位)
        $search_field = (!empty($set['name'])) ? $set['name'] : '';

        $auto = (isset($set['auto'])) ? $set['auto'] : '';
        $autosetup = (isset($set['autosetup'])) ? $set['autosetup'] : '';

        $view = View::make(
            'Fantasy.cms.includes.template.select',
            [
                'search' => $search,
                'sontable' => $sontable,
                'name' => $name,
                'title' => $title,
                'explanation' => $explanation,
                'tip' => $tip,
                'value' => $value,
                'empty' => $empty,
                'options' => $options,
                'disabled' => $disabled,
                'options_group_set' => $options_group_set,
                'options_group' => $options_group,
                'search_field' => $search_field,
                'auto' => $auto,
                'autosetup' => $autosetup,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /*單選-關聯資料集*/
    public static function selectBydata($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $explanation = (!empty($set['explanation'])) ? $set['explanation'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        // 要關聯的資料表
        $model = (!empty($set['model'])) ? $set['model'] : 0;

        //是否可以不選
        $empty = (!empty($set['empty'])) ? $set['empty'] : 'no';

        //選項
        $options = (!empty($set['options'])) ? $set['options'] : [];

        // 是否disabled-若要使用disabled請用select
        // $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        // 若為搜尋用，要搜尋的欄位(目前直接用name的欄位)
        $search_field = (!empty($set['name'])) ? $set['name'] : '';

        $view = View::make(
            'Fantasy.cms.includes.template.selectBydata',
            [
                'search' => $search,
                'sontable' => $sontable,
                'name' => $name,
                'title' => $title,
                'explanation' => $explanation,
                'tip' => $tip,
                'value' => $value,
                'model' => $model,
                'empty' => $empty,
                'options' => $options,
                'search_field' => $search_field,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /*多選*/
    public static function selectMulti($set = [])
    {
        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 是否為sontable新增用模版
        $set['sontable_add'] = (!empty($set['sontable_add'])) ? true : false;

        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $options = (!empty($set['options'])) ? $set['options'] : [];
        $disabled = (!empty($set['disabled']) && $set['disabled'] == 'disabled') ? true : false;
        $select_all = (!empty($set['select_all']) && $set['select_all'] == 'true') ? true : false;

        /*隨機亂碼*/
        // $length = 12;
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        // $charactersLength = strlen($characters);
        // $randomWord = '';
        // for ($i = 0; $i < $length; $i++) 
        // {
        //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
        // }
        $randomWord =  Str::random(12);

        // 判斷options中各項目是否有被選中
        if (!empty($value)) {
            $value_array = collect(json_decode($value, true))->toarray();
            $options = collect($options)->mapWithKeys(function ($item, $key) use ($value_array) {
                return [$key => ['key' => $item['key'], 'title' => $item['title'], 'default' => in_array($item['key'], $value_array) ? true : false]];
            })->all();
        } else {
            $options = collect($options)->mapWithKeys(function ($item, $key) {
                return [$key => ['key' => $item['key'], 'title' => $item['title'], 'default' => false]];
            })->all();
        }

        $view = View::make(
            'Fantasy.cms.includes.template.selectMulti',
            [
                'title' => $title,
                'randomWord' => $randomWord,
                'name' => $name,
                'value' => $value,
                'disabled' => $disabled,
                'options' => $options,
                'tip' => $tip,
                'select_all' => $select_all,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /**多選-關聯資料集 */
    public static function selectMultiBydata($set = [])
    {
        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 是否為sontable新增用模版
        $set['sontable_add'] = (!empty($set['sontable_add'])) ? true : false;

        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $options = (!empty($set['options'])) ? $set['options'] : [];
        $disabled = (!empty($set['disabled']) && $set['disabled'] == 'disabled') ? true : false;

        // 要關聯的資料表
        $model = (!empty($set['model'])) ? $set['model'] : 0;
        //是否可以不選
        $empty = (!empty($set['empty'])) ? $set['empty'] : 'no';

        /*隨機亂碼*/
        // $length = 12;
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        // $charactersLength = strlen($characters);
        // $randomWord = '';
        // for ($i = 0; $i < $length; $i++) 
        // {
        //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
        // }
        $randomWord =  Str::random(12);
        // 判斷options中各項目是否有被選中
        if (!empty($value)) {
            $value_array = collect(json_decode($value, true))->toarray();
            $options = collect($options)->mapWithKeys(function ($item, $key) use ($value_array) {
                return [$key => ['key' => $item['key'], 'title' => $item['title'], 'default' => in_array($item['key'], $value_array) ? true : false]];
            })->all();
        } else {
            $options = collect($options)->mapWithKeys(function ($item, $key) {
                return [$key => ['key' => $item['key'], 'title' => $item['title'], 'default' => false]];
            })->all();
        }

        $view = View::make(
            'Fantasy.cms.includes.template.selectMultiBydata',
            [
                'title' => $title,
                'sontable' => $sontable,
                'randomWord' => $randomWord,
                'name' => $name,
                'value' => $value,
                'disabled' => $disabled,
                'options' => $options,
                'tip' => $tip,
                'model' => $model,
                'empty' => $empty,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /*=======關聯式下拉選單=======*/
    public static function selectGroup($set = [])
    {
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        // 整理參數
        $set['search'] = (!empty($set['search'])) ? true : false; // 是否為搜尋用欄位
        $set['sontable'] = (!empty($set['sontable'])) ? true : false; // 是否為sontable用
        $set['sontable_add'] = (!empty($set['sontable_add'])) ? true : false; // 是否為sontable新增用模版
        $set['prefix'] = ($set['search'] === true) ? 'search_' : ((!empty($set['rand'])) ? $set['rand'] . '_' : '');
        $set['name'] = (!empty($set['name'])) ? $set['name'] : '';
        $set['value'] = (!empty($set['value'])) ? $set['value'] : 0;
        $set['parents'] = (!empty($set['parents'])) ? $set['parents'] : [];

        $html = '';
        if ($value != 0) $html = self::selectGroupUpward($set);
        else $html = self::selectGroupDownward($set);

        // if($set['sontable']===true) return $html;
        // else 
        echo $html;
    }
    /*由上向下產生關聯式下拉選單*/
    public static function selectGroupDownward($set = [])
    {
        $search = $set['search'];
        $sontable = $set['sontable'];
        $sontable_add = $set['sontable_add'];
        $prefix = $set['prefix'];
        $name = ($search === true ? "search_" : "") . $set['name'];
        $value = $set['value'];
        $parents = $set['parents'];
        $group_lvs = count($parents) - 1;
        $search_field = $set['name']; //要搜尋的欄位

        $arr_select = [];

        for ($i = $group_lvs; $i >= 0; $i--) {
            $row = $parents[$i];
            $lv_data = [
                'model' => (!empty($row['model'])) ? $row['model'] : '',
                'title' => (!empty($row['title'])) ? $row['title'] : '',
                'explanation' => (!empty($row['explanation'])) ? $row['explanation'] : '',
                'tip' => (!empty($row['tip'])) ? $row['tip'] : '',
                'option_text' => $row['option_text'],
                'value' => $value,
                'empty' => (!empty($row['empty'])) ? $row['empty'] : 'no',
            ];
            if ($i == $group_lvs) {
                $lv_data['options'] = (Config::get('models.' . $lv_data['model']))::where('branch_id', parent::$baseBranchId)->get()->keyBy('id')->toArray();
            } else {
                $model = app(Config::get('models.' . $lv_data['model']));
                $lv_data['options'] = $model::where('branch_id', parent::$baseBranchId)->where($model::parent_key[$parents[$i + 1]['model']], $arr_select[0]['value'])->get()->keyBy('id')->toArray();
            }
            $arr = $lv_data['options'];
            $lv_data['value'] = key($lv_data['options']);

            array_unshift($arr_select, $lv_data);
        }

        $html = '';
        for ($i = $group_lvs; $i >= 0; $i--) {
            $row = $arr_select[$i];

            $html .= '<li class="inventory' . ($sontable === true ? '' : ' row_style') . ($i == 0 && $search === true ? ' card_search_input" data-search_type="single_select" data-search_field="' . $search_field . '"' : '"') . '>';
            $html .= $sontable === true ? '' : '<div class="title">';
            $html .= '<p class="subtitle">' . $row['title'] . '</p>';
            $html .= $sontable === true ? '' : '</div>';
            $html .= $sontable === true ? '' : '<div class="inner">';
            $html .= '<div class="quill_select">';
            $html .= '<div class="select_object">';

            // 若為新增用模版，則在class加上addSelectGroupP，id在cms_unit.js產生新列時帶參數產生
            $html .= '<p class="title' . ($sontable_add === true ? ' addSelectGroupP"' : '" id="relselo_' . $prefix . $row['model'] . '"') . '>';
            if (array_key_exists($row['value'], $row['options'])) {
                $html .= $row['options'][$row['value']][$row['option_text']];
            } else {
                $html .= $row['explanation'];
            }
            $html .= '</p>';

            $html .= '<span class="arrow pg-arrow_down"></span>';
            $html .= '</div>';
            $html .= '<div class="select_wrapper">';

            // 若為新增用模版，則在class加上addSelectGroup，id在cms_unit.js產生新列時帶參數產生
            $html .= '<ul class="select_list edit_select' . ($sontable_add === true ? ' addSelectGroup"' : '" id="relsel_' . $prefix . $row['model'] . '"') . ' data-next="' . ($i == 0 ? '' : $prefix . $arr_select[$i - 1]['model']) . '" data-model="' . $row['model'] . '" data-option_text="' . $row['option_text'] . '" data-hdname="' . $name . '" data-empty="' . ($row['empty'] == 'yes' ? 'yes' : 'no') . '">';

            if ($row['empty'] == 'yes') {
                $html .= '<li class="option relate_select_fantasy" data-id="0"><p>-</p></li>';
            }

            foreach ($row['options'] as $key => $row2) {
                $html .= '<li class="option relate_select_fantasy" data-id="' . $key . '"><p>' . $row2[$row['option_text']] . '</p></li>';
            }

            if ($i == 0) {
                $html .= '<input type="hidden" name="' . $name . '" value="' . $value . '">';
            }
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            //提示窗
            if (!empty($row['tip'])) {
                $html .= '<div class="tips">';
                $html .= '<span class="title">TIPS</span>';
                $html .= '<p>' . $row['tip'] . '</p>';
                $html .= '</div>';
            }
            $html .= $sontable === true ? '' : '</div>';
            $html .= '</li>';
        }

        return $html;
    }
    /*由下向上產生關聯式下拉選單*/
    public static function selectGroupUpward($set = [])
    {
        $search = $set['search'];
        $sontable = $set['sontable'];
        $sontable_add = $set['sontable_add'];
        $prefix = $set['prefix'];
        $name = ($search === true ? "search_" : "") . $set['name'];
        $value = $set['value'];
        $parents = $set['parents'];
        $group_lvs = count($parents);
        $search_field = $set['name']; //要搜尋的欄位

        $arr_select = [];

        for ($i = 0; $i < $group_lvs; $i++) {
            $row = $parents[$i];
            $lv_data = [
                'model' => (!empty($row['model'])) ? $row['model'] : '',
                'title' => (!empty($row['title'])) ? $row['title'] : '',
                'explanation' => (!empty($row['explanation'])) ? $row['explanation'] : '',
                'tip' => (!empty($row['tip'])) ? $row['tip'] : '',
                'option_text' => $row['option_text'],
                'value' => $i == '0' ? $value : $arr_select[0]['parent_value'],
                'empty' => (!empty($row['empty'])) ? $row['empty'] : 'no',
            ];
            if ($i == $group_lvs - 1) {
                $lv_data['options'] = (Config::get('models.' . $lv_data['model']))::where('branch_id', parent::$baseBranchId)->get()->keyBy('id')->toArray();
            } else {
                $model = app(Config::get('models.' . $lv_data['model']));
                $parent_data = clone $model;
                $parent_data = $parent_data->find($lv_data['value'])->toArray();
                $parent_key = $model::parent_key[$parents[$i + 1]['model']];
                $lv_data['parent_value'] = $parent_data[$parent_key];
                $lv_data['options'] = $model::where('branch_id', parent::$baseBranchId)->where($parent_key, $lv_data['parent_value'])->get()->keyBy('id')->toArray();
            }

            array_unshift($arr_select, $lv_data);
        }

        $html = '';
        for ($i = 0; $i < $group_lvs; $i++) {
            $row = $arr_select[$i];

            $html .= '<li class="inventory' . ($sontable === true ? '' : ' row_style') . ($i + 1 == $group_lvs && $search === true ? ' card_search_input" data-search_type="single_select" data-search_field="' . $search_field . '"' : '"') . '>';
            $html .= $sontable === true ? '' : '<div class="title">';
            $html .= '<p class="subtitle">' . $row['title'] . '</p>';
            $html .= $sontable === true ? '' : '</div>';
            $html .= $sontable === true ? '' : '<div class="inner">';
            $html .= '<div class="quill_select">';
            $html .= '<div class="select_object">';

            // 若為新增用模版，則在class加上addSelectGroupP，id在cms_unit.js產生新列時帶參數產生
            $html .= '<p class="title' . ($sontable_add === true ? ' addSelectGroupP"' : '" id="relselo_' . $prefix . $row['model'] . '"') . '>';
            if (array_key_exists($row['value'], $row['options'])) {
                $html .= $row['options'][$row['value']][$row['option_text']];
            } else {
                $html .= $row['explanation'];
            }
            $html .= '</p>';

            $html .= '<span class="arrow pg-arrow_down"></span>';
            $html .= '</div>';
            $html .= '<div class="select_wrapper">';

            // 若為新增用模版，則在class加上addSelectGroup，id在cms_unit.js產生新列時帶參數產生
            $html .= '<ul class="select_list edit_select' . ($sontable_add === true ? ' addSelectGroup"' : '" id="relsel_' . $prefix . $row['model'] . '"') . ' data-next="' . ($i + 1 == $group_lvs ? '' : $prefix . $arr_select[$i + 1]['model']) . '" data-model="' . $row['model'] . '" data-option_text="' . $row['option_text'] . '" data-hdname="' . $name . '" data-empty="' . ($row['empty'] == 'yes' ? 'yes' : 'no') . '">';

            if ($row['empty'] == 'yes') {
                $html .= '<li class="option relate_select_fantasy" data-id="0"><p>-</p></li>';
            }

            foreach ($row['options'] as $key => $row2) {
                $html .= '<li class="option relate_select_fantasy" data-id="' . $key . '"><p>' . $row2[$row['option_text']] . '</p></li>';
            }

            if ($i + 1 == $group_lvs) {
                $html .= '<input type="hidden" name="' . ($search === true ? "search_" : "") . $name . '" value="' . $value . '">';
            }
            $html .= '</ul>';
            $html .= '</div>';
            $html .= '</div>';
            //提示窗
            if (!empty($row['tip'])) {
                $html .= '<div class="tips">';
                $html .= '<span class="title">TIPS</span>';
                $html .= '<p>' . $row['tip'] . '</p>';
                $html .= '</div>';
            }
            $html .= $sontable === true ? '' : '</div>';
            $html .= '</li>';
        }

        return $html;
    }
    /*=======關聯式下拉選單=======*/
    /*色彩選擇器*/
    public static function colorPicker($set = [])
    {
        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        $html =  View::make('Fantasy.cms.includes.template.colorPicker', [
            'set' => $set,
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled
        ])->render();

        echo ($html);
    }
    /*日期選擇器*/
    public static function datePicker($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';
        $search_field = (!empty($set['name'])) ? $set['name'] : ''; //要搜尋的欄位

        $html =  View::make('Fantasy.cms.includes.template.datePicker', [
            'set' => $set,
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled,
            'search_field' => $search_field,
            'search' => $search,
        ])->render();

        echo ($html);
    }
    /*日期區間選擇器*/
    public static function dateRange($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 是否為sontable新增用模版
        $set['sontable_add'] = (!empty($set['sontable_add'])) ? true : false;

        $name = (!empty($set['name'])) ? ($search === true ? 'search_s_' : '') . $set['name'] : '';
        $name2 = (!empty($set['name2'])) ? ($search === true ? 'search_e_' . $set['name'] : $set['name2']) : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $value2 = (!empty($set['value2'])) ? $set['value2'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';
        $search_field = (!empty($set['name'])) ? $set['name'] : ''; //要搜尋的欄位

        $view = View::make(
            'Fantasy.cms.includes.template.dateRange',
            [
                'search' => $search,
                'sontable' => $sontable,
                'name' => $name,
                'name2' => $name2,
                'title' => $title,
                'tip' => $tip,
                'value' => $value,
                'value2' => $value2,
                'disabled' => $disabled,
                'search_field' => $search_field,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
    /*圖片群組*/
    public static function imageGroup($set = [])
    {
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $image_array = (!empty($set['image_array'])) ? $set['image_array'] : [];

        $fileInformationArray = [];
        $fileIds = [];
        foreach ($image_array as $key_img => $value_img) {
            array_push($fileIds, $value_img['value']);
        }
        if (!empty($fileIds)) {
            $fileInformationArray = BaseFunction::getFilesArray($fileIds);
        }

        $html =  View::make('Fantasy.cms.includes.template.imageGroup', [
            'set' => $set,
            'title' => $title,
            'tip' => $tip,
            'image_array' => $image_array,
            'fileInformationArray' => $fileInformationArray,
            'fileIds' => $fileIds,
        ])->render();

        echo ($html);
    }
    /*檔案選擇器*/
    public static function filePicker($set = [])
    {
        $name = (!empty($set['name'])) ? $set['name'] : '';
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';
        $value = (!empty($set['value'])) ? $set['value'] : '';
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        $html =  View::make('Fantasy.cms.includes.template.filePicker', [
            'set' => $set,
            'name' => $name,
            'title' => $title,
            'tip' => $tip,
            'value' => $value,
            'disabled' => $disabled,
        ])->render();

        echo ($html);
    }
    public static function sonTable($set = [])
    {
        $value = (!empty($set['value'])) ? $set['value'] : [];
        $table_tip = (!empty($set['tip'])) ? $set['tip'] : '';

        $sort = (!empty($set['sort'])) ? $set['sort'] : 'yes';
        $create = (!empty($set['create'])) ? $set['create'] : 'yes';
        $MultiImgcreate = (!empty($set['MultiImgcreate'])) ? $set['MultiImgcreate'] : 'no';
        $MultiDatacreate = (!empty($set['MultiDatacreate'])) ? $set['MultiDatacreate'] : 'no';
        $delete = (!empty($set['delete'])) ? $set['delete'] : 'yes';
        $teach = (!empty($set['teach'])) ? $set['teach'] : 'no';

        $is_link = (!empty($set['is_link'])) ? $set['is_link'] : 'no';
        $link_class = (!empty($set['link_class'])) ? $set['link_class'] : '';
        $link_key = (!empty($set['link_key'])) ? $set['link_key'] : [];

        $hasContent = (!empty($set['hasContent'])) ? $set['hasContent'] : 'no';

        $tableSet = (!empty($set['tableSet'])) ? $set['tableSet'] : [];
        $tabSet = (!empty($set['tabSet'])) ? $set['tabSet'] : [];

        /*隨機亂碼*/
        // $length = 9;
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        // $charactersLength = strlen($characters);
        // $randomWord = '';
        // for ($i = 0; $i < $length; $i++) 
        // {
        //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
        // }
        $randomWord =  Str::random(9);
        $stack =  View::make('Fantasy.cms.includes.template.sontable.stack', [
            'set' => $set,
            'value' => $value,
            'table_tip' => $table_tip,
            'sort' => $sort,
            'create' => $create,
            'MultiImgcreate' => $MultiImgcreate,
            'MultiDatacreate' => $MultiDatacreate,
            'delete' => $delete,
            'teach' => $teach,
            'is_link' => $is_link,
            'link_class' => $link_class,
            'link_key' => $link_key,
            'hasContent' => $hasContent,
            'tableSet' => $tableSet,
            'tabSet' => $tabSet,
            'randomWord' => $randomWord
        ])->render();

        $sontable =  View::make('Fantasy.cms.includes.template.sontable.index', [
            'set' => $set,
            'value' => $value,
            'table_tip' => $table_tip,
            'sort' => $sort,
            'create' => $create,
            'MultiImgcreate' => $MultiImgcreate,
            'MultiDatacreate' => $MultiDatacreate,
            'delete' => $delete,
            'teach' => $teach,
            'is_link' => $is_link,
            'link_class' => $link_class,
            'link_key' => $link_key,
            'hasContent' => $hasContent,
            'tableSet' => $tableSet,
            'tabSet' => $tabSet,
            'randomWord' => $randomWord,
            'stack' => $stack
        ])->render();

        echo ($sontable);
    }
    // Whole New Son Table
    public static function WNsonTable($set = [])
    {
        $value = (!empty($set['value'])) ? $set['value'] : [];
        $table_tip = (!empty($set['tip'])) ? $set['tip'] : '';

        $sort = (!empty($set['sort'])) ? $set['sort'] : 'yes';
        $create = (!empty($set['create'])) ? $set['create'] : 'yes';
        $MultiImgcreate = (!empty($set['MultiImgcreate'])) ? $set['MultiImgcreate'] : 'no';
        $MultiDatacreate = (!empty($set['MultiDatacreate'])) ? $set['MultiDatacreate'] : 'no';
        $delete = (!empty($set['delete'])) ? $set['delete'] : 'yes';
        $teach = (!empty($set['teach'])) ? $set['teach'] : 'no';

        $is_link = (!empty($set['is_link'])) ? $set['is_link'] : 'no';
        $link_class = (!empty($set['link_class'])) ? $set['link_class'] : '';
        $link_key = (!empty($set['link_key'])) ? $set['link_key'] : [];

        $hasContent = (!empty($set['hasContent'])) ? $set['hasContent'] : 'no';

        $tableSet = (!empty($set['tableSet'])) ? $set['tableSet'] : [];
        $tabSet = (!empty($set['tabSet'])) ? $set['tabSet'] : [];

        /*隨機亂碼*/
        // $length = 9;
        // $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        // $charactersLength = strlen($characters);
        // $randomWord = '';
        // for ($i = 0; $i < $length; $i++) {
        //     $randomWord .= $characters[rand(0, $charactersLength - 1)];
        // }
        $randomWord =  Str::random(9);
        $stack =  View::make('Fantasy.cms.includes.template.WNsontable.stack', [
            'set' => $set,
            'value' => $value,
            'table_tip' => $table_tip,
            'sort' => $sort,
            'create' => $create,
            'MultiImgcreate' => $MultiImgcreate,
            'MultiDatacreate' => $MultiDatacreate,
            'delete' => $delete,
            'teach' => $teach,
            'is_link' => $is_link,
            'link_class' => $link_class,
            'link_key' => $link_key,
            'hasContent' => $hasContent,
            'tableSet' => $tableSet,
            'tabSet' => $tabSet,
            'randomWord' => $randomWord
        ])->render();

        $sontable =  View::make('Fantasy.cms.includes.template.WNsontable.index', [
            'set' => $set,
            'value' => $value,
            'table_tip' => $table_tip,
            'sort' => $sort,
            'create' => $create,
            'MultiImgcreate' => $MultiImgcreate,
            'MultiDatacreate' => $MultiDatacreate,
            'delete' => $delete,
            'teach' => $teach,
            'is_link' => $is_link,
            'link_class' => $link_class,
            'link_key' => $link_key,
            'hasContent' => $hasContent,
            'tableSet' => $tableSet,
            'tabSet' => $tabSet,
            'randomWord' => $randomWord,
            'stack' => $stack
        ])->render();

        echo ($sontable);
    }
    /*單選-level1*/
    public static function select2($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;
        // 搜尋欄位是否為多選
        $search_multi = (!empty($set['search_multi'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $explanation = (!empty($set['explanation'])) ? $set['explanation'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ? $set['value'] : 0;

        //是否可以不選
        $empty = (!empty($set['empty'])) ? $set['empty'] : 'no';

        //選項
        $options = (!empty($set['options'])) ? $set['options'] : [];

        // 是否disabled
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        //關聯式下拉選單用
        $options_group_set = (!empty($set['options_group_set'])) ? $set['options_group_set'] : 'no';
        $options_group = (!empty($set['options_group'])) ? $set['options_group'] : [];

        // 若為搜尋用，要搜尋的欄位(目前直接用name的欄位)
        $search_field = (!empty($set['name'])) ? $set['name'] : '';
        $custom = (isset($set['custom'])) ? $set['custom'] : false;

        // 段落編輯器用
        $article4 = (isset($set['article4'])) ? $set['article4'] : false;

        //Auto
        $auto = (isset($set['auto'])) ? $set['auto'] : '';
        $autosetup = (isset($set['autosetup'])) ? $set['autosetup'] : '';

        $tableData = (isset($set['tableData']) && !empty($set['tableData'])) ? $set['tableData'] : [];
        $tableData['model'] = (isset($set['tableData']) && !empty($set['tableData'])) ? $set['tableData']['model'] : '';
        $tableData['table'] = (isset($set['tableData']) && !empty($set['tableData'])) ? $set['tableData']['table'] : '';
        $tableData['for'] = (isset($set['tableData']) && !empty($set['tableData'])) ? $set['tableData']['for'] : '';

        if ($custom == false) {
            $view = View::make(
                'Fantasy.cms.includes.template.select2',
                [
                    'search' => $search,
                    'search_multi' => $search_multi,
                    'sontable' => $sontable,
                    'name' => $name,
                    'title' => $title,
                    'explanation' => $explanation,
                    'tip' => $tip,
                    'value' => $value,
                    'empty' => $empty,
                    'options' => $options,
                    'disabled' => $disabled,
                    'options_group_set' => $options_group_set,
                    'options_group' => $options_group,
                    'search_field' => $search_field,
                    'article4' => $article4,
                    'auto' => $auto,
                    'tableData' => $tableData,
                    'autosetup' => $autosetup,
                ]
            )->Render();
        } else {
            $view = View::make(
                'Fantasy.cms.includes.template.select2_custom',
                [
                    'search' => $search,
                    'sontable' => $sontable,
                    'name' => $name,
                    'title' => $title,
                    'explanation' => $explanation,
                    'tip' => $tip,
                    'value' => $value,
                    'empty' => $empty,
                    'options' => $options,
                    'disabled' => $disabled,
                    'options_group_set' => $options_group_set,
                    'options_group' => $options_group,
                    'search_field' => $search_field,
                    'article4' => $article4,
                    'auto' => $auto,
                    'autosetup' => $autosetup,
                ]
            )->Render();
        }


        // if ($sontable === true) return $view;
        // else 
        echo $view;
    }
    /*多選-level1*/
    public static function select2Multi($set = [])
    {
        // 是否為搜尋用欄位
        $search = (!empty($set['search'])) ? true : false;

        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? ($search === true ? 'search_' : '') . $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';
        $explanation = (!empty($set['explanation'])) ? $set['explanation'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ?  json_decode($set['value'], true) : 0;
        //是否可以不選
        $empty = (!empty($set['empty'])) ? $set['empty'] : 'no';

        //選項
        $options = (!empty($set['options'])) ? $set['options'] : [];

        // 是否disabled
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        //關聯式下拉選單用
        $options_group_set = (!empty($set['options_group_set'])) ? $set['options_group_set'] : 'no';
        $options_group = (!empty($set['options_group'])) ? $set['options_group'] : [];

        // 若為搜尋用，要搜尋的欄位(目前直接用name的欄位)
        $search_field = (!empty($set['name'])) ? $set['name'] : '';
        $custom = (isset($set['custom'])) ? $set['custom'] : false;

        if ($custom == false) {
            $view = View::make(
                'Fantasy.cms.includes.template.select2Multi',
                [
                    'search' => $search,
                    'sontable' => $sontable,
                    'name' => $name,
                    'title' => $title,
                    'explanation' => $explanation,
                    'tip' => $tip,
                    'value' => $value,
                    'empty' => $empty,
                    'options' => $options,
                    'disabled' => $disabled,
                    'options_group_set' => $options_group_set,
                    'options_group' => $options_group,
                    'search_field' => $search_field,
                ]
            )->Render();
        } else {
            $view = View::make(
                'Fantasy.cms.includes.template.select2Multi_custom',
                [
                    'search' => $search,
                    'sontable' => $sontable,
                    'name' => $name,
                    'title' => $title,
                    'explanation' => $explanation,
                    'tip' => $tip,
                    'value' => $value,
                    'empty' => $empty,
                    'options' => $options,
                    'disabled' => $disabled,
                    'options_group_set' => $options_group_set,
                    'options_group' => $options_group,
                    'search_field' => $search_field,
                ]
            )->Render();
        }


        // if ($sontable === true) return $view;
        // else 
        echo $view;
    }
    /*summer_note 編輯區塊*/
    public static function sn_textArea($set = [])
    {
        // 是否為sontable用
        $sontable = (!empty($set['sontable'])) ? true : false;

        // 控件名稱
        $name = (!empty($set['name'])) ? $set['name'] : '';

        // 頁面顯示標題
        $title = (!empty($set['title'])) ? $set['title'] : '';

        // 提示框
        $tip = (!empty($set['tip'])) ? $set['tip'] : '可輸入多行文字，內容支援HTML及CSS、JQ、JS等語法，斷行請多利用Shift+Enter或於按下/按鈕，進入原始碼編輯模式中輸入，輸入區域可拖曳右下角縮放，請特別留意不要直接從網頁、office檔案中直接複製內容貼到編輯區';

        // 控件的值(資料表欄位)
        $value = (!empty($set['value'])) ? $set['value'] : '';

        // 是否disabled
        $disabled = (!empty($set['disabled'])) ? $set['disabled'] : '';

        $view = View::make(
            'Fantasy.cms.includes.template.sn_textArea',
            [
                'sontable' => $sontable,
                'name' => $name,
                'title' => $title,
                'tip' => $tip,
                'value' => $value,
                'disabled' => $disabled,
            ]
        )->Render();

        // if($sontable===true) return $view;
        // else 
        echo $view;
    }
}
