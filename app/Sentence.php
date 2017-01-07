<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sentence extends Model
{
    protected $fillable = [
        'article_id', 'paragraph_id', 'sentence',
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function paragraph()
    {
        return $this->belongsTo('App\Paragraph');
    }

    public function words()
    {
        return $this->hasMany('App\Word');
    }
}
