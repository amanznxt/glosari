<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    protected $fillable = [
        'lexicon_id', 'name',
    ];

    public function lexicon()
    {
        return $this->belongsTo('App\Lexicon');
    }
}
