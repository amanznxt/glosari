<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $fillable = [
        'user_id', 'title', 'article', 'url', 'date',
    ];

    protected $dates = [
        'date',
    ];

    public function paragraphs()
    {
        return $this->hasMany('App\Paragraph');
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
