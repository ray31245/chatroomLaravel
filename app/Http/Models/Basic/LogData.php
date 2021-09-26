<?php

namespace App\Http\Models\Basic;

use Illuminate\Database\Eloquent\Model;

class LogData extends Model
{
    protected $table = 'basic_log_data';
	public $timestamps = false;
    protected $primaryKey = 'id';

}