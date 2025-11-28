<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlternativeValue extends Model
{
    protected $fillable = [
        'alternative_id',
        'criterion_id',
        'value',
    ];
}
