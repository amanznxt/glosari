<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpellingRule extends Model
{
    protected $fillable = [
        'type', 'key', 'value', 'contain', 'raw',
    ];

    public function dictionaries()
    {
        return $this->belongsToMany('App\Dictionary', 'dictionary_rules', 'rule_id', 'dictionary_id');
    }
}
