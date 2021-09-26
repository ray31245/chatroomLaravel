<?php

namespace App\Http\Models\Basic;

use Config;

use Illuminate\Database\Eloquent\Model;

class FantasyUsers extends Model
{
    public function __construct()
    {
        $this->setTable("basic_fantasy_users");
    }
}