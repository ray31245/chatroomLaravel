<?php

namespace App\Http\Models\Basic\Data;

use Config;

use Illuminate\Database\Eloquent\Model;

class CountryCodes extends Model
{

    public function __construct()
    {
        $this->setTable("basic_country_codes");
    }
}