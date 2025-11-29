<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Criteria extends Model
{
    protected $table = 'criteria';

    public $fillable = [
        'code', 'name', 'type', 'unit', 'description', 'active',
    ];

    public function alternatives()
    {
        return $this->belongsToMany(Alternative::class, 'alternative_values')
            ->withPivot('value')
            ->withTimestamps();
    }
}
