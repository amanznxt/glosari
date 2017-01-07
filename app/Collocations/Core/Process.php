<?php

namespace App\Collocations\Core;

use App\Article;
use App\Dictionary;
use App\Jobs\ScrapDbp;
use Carbon\Carbon;

/**
 * Process the Article given
 */
class Process
{
    public static function work($id)
    {
        // get the article
        $article = Article::find($id);

        $paragraphs = self::articleToParagraph($article);

        $sentences = self::paragraphToSentence($paragraphs);

        $words = self::sentenceToWord($sentences);

        $list = [];

        foreach ($words as $key => $value) {

            if (!self::_contained($value)) {
                $dictionary = Dictionary::firstOrCreate([
                    'name' => $value,
                ]);

                if (empty($dictionary->lexicon_id)) {
                    $job = (new ScrapDbp($dictionary))
                        ->delay(Carbon::now()->addSeconds(10));

                    dispatch($job);
                }
            }
        }
    }

    public static function articleToParagraph($article)
    {
        // split article into paragraph
        $_paragraphs = self::_split("/\n/", $article->article); // based on newline
        $paragraphs = [];
        foreach ($_paragraphs as $key => $value) {
            $v = trim($value);
            if (!empty($v)) {
                $paragraphs[] = $value;
            }
        }
        // dd($paragraphs);
        return $paragraphs;
    }

    public static function paragraphToSentence($paragraphs)
    {
        $pattern = '/([.?!])/i';
        $replacement = '$0|';
        $sentences = [];
        foreach ($paragraphs as $key => $value) {
            $_sentences = self::_replace($pattern, $replacement, $value);
            $_sentences = explode('|', $_sentences);
            foreach ($_sentences as $key => $value) {
                $value = trim($value);
                if (!empty($value)) {
                    $sentences[] = $value;
                }
            }
        }
        // dd($sentences);
        return $sentences;
    }

    public static function sentenceToWord($sentences)
    {
        $pattern = '/[\s]+/i';
        $words = [];
        foreach ($sentences as $key => $value) {
            $_words = self::_split($pattern, $value);

            foreach ($_words as $k => $v) {
                if (!empty($v)) {
                    $contained = self::_contained($v);
                    if ($contained != false) {
                        $v = str_replace($contained['type'], '', $v);
                        $words[] = $v;
                        $words[] = $contained['type'];
                    } else {
                        $words[] = $v;
                    }
                }
            }
        }
        return $words;
    }

    public static function _contained($value)
    {
        $contained_dot = strpos($value, '.');
        $contained_comma = strpos($value, ',');
        $contained_question_mark = strpos($value, '?');
        $contained_exclamation_mark = strpos($value, '!');
        if ($contained_dot !== false) {
            return ['pos' => $contained_dot, 'type' => '.'];
        }
        if ($contained_comma !== false) {
            return ['pos' => $contained_comma, 'type' => ','];
        }
        if ($contained_question_mark !== false) {
            return ['pos' => $contained_question_mark, 'type' => '?'];
        }
        if ($contained_exclamation_mark !== false) {
            return ['pos' => $contained_exclamation_mark, 'type' => '!'];
        }
        return false;
    }

    public static function _split($pattern, $value, $flag = -1)
    {
        return preg_split($pattern, $value, $flag);
    }

    public static function _replace($pattern, $replacement, $value)
    {
        return preg_replace($pattern, $replacement, $value);
    }
}
