<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weights extends Model
{
    protected $table = 'weights';

    protected $fillable = [
        'criteria_id',
        'weight',
        'method',
        'source',

    ];
}
