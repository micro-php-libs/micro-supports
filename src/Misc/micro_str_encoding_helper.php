<?php

if (!function_exists('ms_mb_utf8_convert')) {
    function ms_mb_utf8_convert($str, $input = 'utf-8')
    {
        if ($str && is_string($str)) {
            return mb_convert_encoding(trim($str), $input, 'UTF-8');
        }
        if (is_array($str)) {
            $arr = [];
            foreach ($str as $key => $s) {
                if ($s && is_string($s)) {
                    $arr[$key] = mb_convert_encoding(trim($s), 'UTF-8', 'UTF-8');
                }
            }
            return $arr;
        }
        return $str;
    }
}

if (!function_exists('ms_bad_character_fix')) {
    function ms_bad_character_fix($str)
    {
        if ($str && is_string($str)) {
            $str = preg_replace_callback('#\\\\x([[:xdigit:]]{2})#ism', function ($matches) {
                return chr(hexdec($matches[1]));
            }, $str);
        }
        if (is_array($str)) {
            $arr = [];
            foreach ($str as $key => $s) {
                if ($s && is_string($s)) {
                    $arr[$key] = preg_replace_callback('#\\\\x([[:xdigit:]]{2})#ism', function ($matches) {
                        return chr(hexdec($matches[1]));
                    }, $s);
                }
            }
            return $arr;
        }
        return $str;
    }
}

if (!function_exists('ms_w1250_to_utf8')) {
    function ms_w1250_to_utf8($text)
    {
        // map based on:
        // http://konfiguracja.c0.pl/iso02vscp1250en.html
        // http://konfiguracja.c0.pl/webpl/index_en.html#examp
        // http://www.htmlentities.com/html/entities/
        $map = array(
            chr(0x8A) => chr(0xA9),
            chr(0x8C) => chr(0xA6),
            chr(0x8D) => chr(0xAB),
            chr(0x8E) => chr(0xAE),
            chr(0x8F) => chr(0xAC),
            chr(0x9C) => chr(0xB6),
            chr(0x9D) => chr(0xBB),
            chr(0xA1) => chr(0xB7),
            chr(0xA5) => chr(0xA1),
            chr(0xBC) => chr(0xA5),
            chr(0x9F) => chr(0xBC),
            chr(0xB9) => chr(0xB1),
            chr(0x9A) => chr(0xB9),
            chr(0xBE) => chr(0xB5),
            chr(0x9E) => chr(0xBE),
            chr(0x80) => '&euro;',
            chr(0x82) => '&sbquo;',
            chr(0x84) => '&bdquo;',
            chr(0x85) => '&hellip;',
            chr(0x86) => '&dagger;',
            chr(0x87) => '&Dagger;',
            chr(0x89) => '&permil;',
            chr(0x8B) => '&lsaquo;',
            chr(0x91) => '&lsquo;',
            chr(0x92) => '&rsquo;',
            chr(0x93) => '&ldquo;',
            chr(0x94) => '&rdquo;',
            chr(0x95) => '&bull;',
            chr(0x96) => '&ndash;',
            chr(0x97) => '&mdash;',
            chr(0x99) => '&trade;',
            chr(0x9B) => '&rsquo;',
            chr(0xA6) => '&brvbar;',
            chr(0xA9) => '&copy;',
            chr(0xAB) => '&laquo;',
            chr(0xAE) => '&reg;',
            chr(0xB1) => '&plusmn;',
            chr(0xB5) => '&micro;',
            chr(0xB6) => '&para;',
            chr(0xB7) => '&middot;',
            chr(0xBB) => '&raquo;',
        );
        return html_entity_decode(mb_convert_encoding(strtr($text, $map), 'UTF-8', 'ISO-8859-2'), ENT_QUOTES, 'UTF-8');
    }
}