<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    public $fillable = [
        'code', 'name', 'model', 'year', 'description', 'type',
    ];
}
