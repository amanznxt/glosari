<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lexicon extends Model
{
    protected $fillable = [
        'name', 'tag', 'parent_id',
    ];

    public function category()
    {
        return $this->belongsTo('App\Lexicon', 'parent_id');
    }
}
