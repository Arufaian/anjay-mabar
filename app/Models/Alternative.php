<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alternative extends Model
{
    protected $fillable = [
        'code', 'name', 'model', 'year', 'description', 'type',
    ];

    public function alternativeValues()
    {
        return $this->hasMany(AlternativeValue::class);
    }

    public function criteria()
    {
        return $this->belongsToMany(Criteria::class, 'alternative_values')
            ->withPivot('value', 'notes')
            ->withTimestamps();
    }
}
