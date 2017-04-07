<?php

namespace App\Collocations\Core;

/**
 * Split given article to paragraphs, paragraphs to sentences, sentences to words.
 */
class Splitter
{
    public static $delimeters = ['.', ',', '!', '?'];
    /**
     * Split given article to paragraphs
     * @param  [string] $article [Full text of an article]
     * @return [array]          [List of paragraphs]
     */
    public static function articleToParagraphs($article)
    {
        $_paragraphs = self::_split("/\n/", $article); // based on newline
        $paragraphs  = [];
        foreach ($_paragraphs as $key => $value) {
            $v = trim($value);
            if (!empty($v)) {
                $paragraphs[] = $value;
            }
        }
        return $paragraphs;
    }

    /**
     * Split given paragraph to sentences
     * @param  [string] $article [A paragraph]
     * @return [array]          [List of sentences]
     */
    public static function paragraphsToSentences($paragraphs)
    {
        $pattern     = '/([.?!])/i';
        $replacement = '$0|';
        $sentences   = [];
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
        return $sentences;
    }

    /**
     * Split given sentence to words
     * @param  [string] $sentence [Full text of an sentence]
     * @return [array]          [List of words]
     */
    public static function sentencesToWords($sentences)
    {
        $pattern = '/[\s]+/i';
        $words   = [];
        foreach ($sentences as $key => $value) {
            $_words = self::_split($pattern, $value);
            foreach ($_words as $k => $v) {
                $v = self::_cleanWord($v);
                if (!empty($v)) {
                    $contained = self::_contained($v);
                    if ($contained != false) {
                        $v       = str_replace($contained['type'], '', trim($v));
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

    public static function _cleanWord($word)
    {
        return preg_replace("/[^A-Za-z0-9\-]/", '', $word);
    }

    /**
     * Check if word given contained  . , ? !
     * Use for check end of sentence
     * @param  [type] $value [description]
     * @return [type]        [description]
     */
    public static function _contained($value)
    {
        $contained_dot              = strpos($value, '.');
        $contained_comma            = strpos($value, ',');
        $contained_question_mark    = strpos($value, '?');
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

    /**
     * Simplified preg_split
     * @param  [regex]  $pattern [Regex Patter]
     * @param  [string] $value   [String to read]
     * @param  integer     $flag    [description]
     * @return [array]           [List of items]
     */
    public static function _split($pattern, $value, $flag = -1)
    {
        return preg_split($pattern, $value, $flag);
    }

    /**
     * Simplified preg_replace
     * @param  [regex]  $pattern [Regex Patter]
     * @param  [string] $value   [String to read]
     * @return [array]           [List of items]
     */
    public static function _replace($pattern, $replacement, $value)
    {
        return preg_replace($pattern, $replacement, $value);
    }
}
