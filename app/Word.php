<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    protected $fillable = [
        'article_id', 'paragraph_id', 'sentence_id', 'lexicon_id', 'word',
    ];

    public function article()
    {
        return $this->belongsTo('App\Article');
    }

    public function paragraph()
    {
        return $this->belongsTo('App\Paragraph');
    }

    public function sentence()
    {
        return $this->belongsTo('App\Sentence');
    }

    public function lexicon()
    {
        return $this->belongsTo('App\Lexicon');
    }
}
