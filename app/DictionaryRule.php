<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DictionaryRule extends Model
{
    protected $timestamp = false;

    protected $fillable = [
        'dictionary_id', 'rule_id',
    ];
}
