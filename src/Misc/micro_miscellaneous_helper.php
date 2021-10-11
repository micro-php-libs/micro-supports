<?php

if (!function_exists('m_str_to_database_column')) {
    /**
     * @param array|string $input (array key => value)
     * @return array|string
     */
    function m_str_to_database_column($input)
    {
        if (is_array($input)) {
            $convert = [];
            foreach ($input as $key => $value) {
                $result = preg_replace('/\B([A-Z])/', '_$1', $key);
                $newKey = strtolower($result);
                $convert[$newKey] = $value;
            }
            return $convert;
        }
        $result = preg_replace('/\B([A-Z])/', '_$1', $input);
        return strtolower($result);
    }
}

if (!function_exists('m_collection_to_select')) {
    /**
     * @param \Illuminate\Support\Collection $collection
     * @param string $keyCol
     * @param string $valueCol
     * @return array|\Illuminate\Support\Collection
     */
    function m_collection_to_select($collection, $keyCol, $valueCol)
    {
        $keyed = $collection->mapWithKeys(function ($item) use ($keyCol, $valueCol) {
            return [$item[$keyCol] => $item[$valueCol]];
        });
        return $keyed;
    }
}

if (!function_exists('m_generate_unique_code')) {
    /**
     * echo unique_code(9);
     * s5s108dfc
     * @param int $limit
     * @return bool|string
     */
    function m_generate_unique_code($limit = 9)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }
}

if (!function_exists('m_class_props_map')) {
    /**
     * @param mixed $class
     * @param int $modifiers ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED
     * @return array
     */
    function m_class_props_map($class, $modifiers = ReflectionProperty::IS_PUBLIC)
    {
        $reflect = new \ReflectionClass($class);
        $props = $reflect->getProperties($modifiers);

        $propMap = [];
        foreach ($props as $prop) {
            $propMap[$prop->getName()] = $prop->getValue($class);
        }
        return $propMap;
    }
}

if (!function_exists('m_class_const_map')) {
    function m_class_const_map($class)
    {
        $reflect = new \ReflectionClass($class);
        $consts = $reflect->getConstants();

        $map = $consts;
        return $map;
    }
}