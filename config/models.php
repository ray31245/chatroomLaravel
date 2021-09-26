<?php

return [
	/*分舘用*/
	"BranchOrigin"=>App\Http\Models\Basic\Branch\BranchOrigin::class,
	"BranchOriginUnit"=>App\Http\Models\Basic\Branch\BranchOriginUnit::class,
	/*Cms*/
	"CmsMenu"=>App\Http\Models\Basic\Cms\CmsMenu::class,
	"CmsPermission"=>App\Http\Models\Basic\Cms\CmsPermission::class,
	"CmsRole"=>App\Http\Models\Basic\Cms\CmsRole::class,
	"CmsChild"=>App\Http\Models\Basic\Cms\CmsChild::class,
	"CmsParent"=>App\Http\Models\Basic\Cms\CmsParent::class,
	"CmsChildSon"=>App\Http\Models\Basic\Cms\CmsChildSon::class,
	"CmsParentSon"=>App\Http\Models\Basic\Cms\CmsParentSon::class,
	/*Crs*/
	"CrsPermission"=>App\Http\Models\Basic\Crs\CrsPermission::class,
	"CrsRole"=>App\Http\Models\Basic\Crs\CrsRole::class,
	/*Data*/
	"DataGeoArea"=>App\Http\Models\Basic\Data\DataGeoArea::class,
	"DataCity"=>App\Http\Models\Basic\Data\DataCity::class,
	"DataCityRegion"=>App\Http\Models\Basic\Data\DataCityRegion::class,
	"CountryCodes"=>App\Http\Models\Basic\Data\CountryCodes::class,
	"CountryData"=>App\Http\Models\Basic\Data\CountryData::class,
	/*Auth*/
	"FantasyUsers"=>App\Http\Models\Basic\FantasyUsers::class,
	/*Fms*/
	"FmsFirst"=>App\Http\Models\Basic\Fms\FmsFirst::class,
	"FmsSecond"=>App\Http\Models\Basic\Fms\FmsSecond::class,
	"FmsThird"=>App\Http\Models\Basic\Fms\FmsThird::class,
	"FmsFile"=>App\Http\Models\Basic\Fms\FmsFile::class,
	"FmsZero"=>App\Http\Models\Basic\Fms\FmsZero::class,
	/*Option*/
	"OptionItem"=>App\Http\Models\Basic\Option\OptionItem::class,
	"OptionSet"=>App\Http\Models\Basic\Option\OptionSet::class,
	/*Basic*/
	"WebKey"=>App\Http\Models\Basic\WebKey::class,
	/*AMS*/
	"AmsRole"=>App\Http\Models\Basic\Ams\AmsRole::class,
	/*----------------我是分隔線-以上為後台基本資料表-----------------*/

	/*----------------我是分隔線-以下為前台全域基本資料表-----------------*/
	"ViewSet"=>App\Http\Models\Overview\ViewSet::class,
	"Seo" => App\Http\Models\Overview\Seo::class,
	"WebsiteSet" => App\Http\Models\Overview\WebsiteSet::class,
];
