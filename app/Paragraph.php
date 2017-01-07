<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Paragraph extends Model
{
    protected $fillable = [
        'article_id', 'paragraph',
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function sentences()
    {
        return $this->hasMany('App\Sentence');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
