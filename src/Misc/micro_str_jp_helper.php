<?php
if (!function_exists('ms_mb_convert_to_hankaku')) {
    function ms_mb_convert_to_hankaku($str)
    {
        return mb_convert_kana($str, 'srna');
    }
}

if (!function_exists('ms_mb_convert_to_hankaku_katakana')) {
    function ms_mb_convert_to_hankaku_katakana($str)
    {
        return mb_convert_kana($str, 'khc');
    }
}

if (!function_exists('ms_mb_convert_to_zenkaku')) {
    function ms_mb_convert_to_zenkaku($str)
    {
        return mb_convert_kana($str, 'RNAS');
    }
}

if (!function_exists('ms_mb_convert_to_zenkaku_katakana')) {
    function ms_mb_convert_to_zenkaku_katakana($str)
    {
        return mb_convert_kana($str, 'KHC');
    }
}

if (!function_exists('ms_mb_convert_to_hankaku_all')) {
    function ms_mb_convert_to_hankaku_all($str)
    {
        return mb_convert_kana($str, 'srnakhc');
    }
}

if (!function_exists('ms_mb_convert_to_zenkaku_all')) {
    function ms_mb_convert_to_zenkaku_all($str)
    {
        return mb_convert_kana($str, 'RNASKHC');
    }
}

if (!function_exists('mb_remove_spaces')) {
    function ms_mb_clear_spaces($str)
    {
        // 青木 望 | 青木　望 -> 青木望
        return str_replace(' ', '', ms_mb_convert_to_hankaku($str));
    }
}

//Kanji
if (!function_exists('ms_is_valid_kanji')) {
    function ms_is_valid_kanji($str)
    {
        // 青木望 → 青木 望 | 青木　望
        return preg_match('/^([一-龠]+)$/', $str) > 0;
    }
}

//全角ひらがな･カタカナのみ
if (!function_exists('ms_is_valid_kana')) {
    function ms_is_valid_kana($str)
    {
        return preg_match('/^([ァ-ヶーぁ-ん]+)$/', $str) > 0;
    }
}

//全角ひらがなのみ
if (!function_exists('is_valid_hiragana')) {
    function is_valid_hiragana($str)
    {
        return preg_match('/^([ぁ-ん]+)$/', $str) > 0;
    }
}

//全角カタカナのみ
if (!function_exists('ms_is_valid_katakana')) {
    function ms_is_valid_katakana($str)
    {
        return preg_match('/^([ァ-ヶー]+)$/', $str) > 0;
    }
}

//半角カタカナのみ
if (!function_exists('ms_is_valid_hankana')) {
    function ms_is_valid_hankana($str)
    {
        return preg_match('/^([ｧ-ﾝﾞﾟ]+)$/', $str) > 0;
    }
}

if (!function_exists('is_only_kanji_except_spaces')) {
    function ms_is_valid_kanji_except_spaces($str)
    {
        // 青木望 → 青木 望 | 青木　望
        $str1 = ms_mb_clear_spaces($str);
        return preg_match('/^([一-龠]+)$/', $str) > 0 || preg_match('/^([一-龠]+)$/', $str1) > 0;
    }
}

if (!function_exists('ms_is_contain_kanji')) {
    function ms_is_contain_kanji($str)
    {
        return preg_match('/[\x{4E00}-\x{9FBF}]/u', $str) > 0;
    }
}

if (!function_exists('ms_is_contain_hiragana')) {
    function ms_is_contain_hiragana($str)
    {
        return preg_match('/[\x{3040}-\x{309F}]/u', $str) > 0;
    }
}

if (!function_exists('ms_is_contain_katakana')) {
    function ms_is_contain_katakana($str)
    {
        return preg_match('/[\x{30A0}-\x{30FF}]/u', $str) > 0;
    }
}