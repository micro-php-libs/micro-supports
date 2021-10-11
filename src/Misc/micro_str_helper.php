<?php

if (!function_exists('ms_substr_fromto')) {
    function ms_substr_fromto($input, $from_s, $to_s)
    {
        $start = 0;
        $end = strlen($input);
        if (!empty($from_s)) {
            $start = strpos($input, $from_s);
        }
        if ($start == -1) {
            $start = 0;
        }
        if (!empty($from_s)) {
            $end = strpos($input, $to_s);
        }
        if ($end == -1) {
            $end = strlen($input);
        }
        return substr($input, $start + strlen($from_s), $end - $start);
    }
}

if (!function_exists('ms_mb_substr_fromto')) {
    function ms_mb_substr_fromto($input, $from_s, $to_s)
    {
        $start = 0;
        $end = mb_strlen($input);
        if (!empty($from_s)) {
            $start = mb_strpos($input, $from_s);
        }
        if ($start == -1) {
            $start = 0;
        }
        if (!empty($from_s)) {
            $end = mb_strpos($input, $to_s);
        }
        if ($end == -1) {
            $end = mb_strlen($input);
        }
        return mb_substr($input, $start + mb_strlen($from_s), $end - $start);
    }
}

if (!function_exists('str_contains')) {
    function ms_str_contains($str, $sub, $caseSensitive = true)
    {
        if (!$caseSensitive) {
            return stripos($str, $sub) !== false;
        }
        return strpos($str, $sub) !== false;
    }
}

if (!function_exists('ms_to_post_date')) {
    function ms_to_post_date($time, $format = 'Y-m-d H:i:s')
    {
        // Thu, 03 Dec 2020 00:31:00 GMT => date( 'Y-m-d H:i:s', time() ),
        return date($format, strtotime($time));
    }
}

if (!function_exists('ms_replace_str')) {
    function ms_replace_str($str, $search, $replace, $caseSensitive = true)
    {
        if ($caseSensitive) {
            return str_replace($search, $replace, $str);
        }
        return str_ireplace($search, $replace, $str);
    }
}