<?php

if (!function_exists('mh_size_from_url')) {
    function mh_size_from_url($url)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, TRUE);
        curl_setopt($ch, CURLOPT_NOBODY, TRUE);

        $data = curl_exec($ch);
        $size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);

        curl_close($ch);
        return $size;
    }
}


if (!function_exists('mh_get_tiny_url')) {
    /**
     *
     * //test it out!
     * $new_url = get_tiny_url('https://davidwalsh.name/php-imdb-information-grabber');
     *
     * //returns http://tinyurl.com/65gqpp
     * echo $new_url
     *
     * @param $url
     * @return mixed
     */
    function mh_get_tiny_url($url)  {
        $ch = curl_init();
        $timeout = 5;
        curl_setopt($ch, CURLOPT_URL, 'http://tinyurl.com/api-create.php?url='.$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}

if (!function_exists('mh_get_url_only')) {
    function mh_get_url_only($url)
    {
        $parsedUrl = parse_url($url);
        $new_url = $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . ($parsedUrl['path'] ?? '');
        return $new_url;
    }
}

if (!function_exists('mh_get_host_from_url')) {
    function mh_get_host_from_url($url)
    {
        return parse_url($url, PHP_URL_HOST);
    }
}

if (!function_exists('mh_get_content_from_url')) {
    function mh_get_content_from_url($url, $use_curl = true, $timeout = 5, $repeat = false)
    {
        if ($use_curl) {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_TIMEOUT, $timeout);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, FALSE);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
            $page_content = curl_exec($ch);
            $header  = curl_getinfo( $ch );
            $redirectLocation = isset($header['redirect_url']) ? $header['redirect_url'] : null;
            curl_close($ch);
            if (!$repeat && $redirectLocation && strpos($redirectLocation, "http") === 0) {
                return mh_get_content_from_url($redirectLocation, $use_curl, $timeout, true);
            }
        } else {
            $page_content = file_get_contents($url);
        }
        return $page_content;
    }
}

if (!function_exists('mh_thumbnail_meta_from_url')) {
    /**
     * @param string $url
     * @param bool $use_curl
     * @param int $timeout
     * @param bool $stripHttps
     * @return string|null
     */
    function mh_thumbnail_meta_from_url($url, $use_curl = false, $timeout = 5, $stripHttps = true)
    {
        // https://www.php.net/get_meta_tags
        //$tags = get_meta_tags($url);
        // Image Keys "twitter:image",  "og:image"
        $page_content = mh_get_content_from_url($url, $use_curl, $timeout);
        if ($page_content) {
            $dom_obj = new DOMDocument();
            libxml_use_internal_errors(true);
            $dom_obj->loadHTML($page_content);
            libxml_clear_errors();
            $thumbnail = null;
            /** @var DOMElement $meta */
            foreach ($dom_obj->getElementsByTagName('meta') as $meta) {
                if ($meta->getAttribute('property') == 'og:image' || $meta->getAttribute('name') == 'twitter:image') {
                    $thumbnail = $meta->getAttribute('content');
                    break;
                }
            }
            return $stripHttps ? mh_strip_http_ssl($thumbnail) : $thumbnail;
        }
        return null;
    }
}

if (!function_exists('mh_strip_http_ssl')) {
    function mh_strip_http_ssl($url)
    {
        $url = str_replace("https://", "//", $url);
        $url = str_replace("http://", "//", $url);

        return $url;
    }
}

if (!function_exists('mh_is_valid_start_url')) {
    function mh_is_valid_start_url($url)
    {
        return strpos($url, '//') === 0
            || strpos($url, 'http://') === 0
            || strpos($url, 'https://') === 0;
    }
}

if (!function_exists('mh_param_from_url')) {
    function mh_param_from_url($url, $param, $default = null)
    {
        // Use parse_url() function to parse the URL
        // and return an associative array which
        // contains its various components
        $url_components = parse_url($url);

        // Use parse_str() function to parse the
        // string passed via URL
        parse_str($url_components['query'], $params);

        // Display result
        return $params[$param] ?? $default;
    }
}