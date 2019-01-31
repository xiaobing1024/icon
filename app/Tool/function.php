<?php

if (! function_exists('cache_map')) {
    function cache_map($k, $d = null) {
        $maps = cache('map', []);
        return array_key_exists($k, $maps) ? $maps[$k] : $d;
    }
}

if (! function_exists('dda')) {
    function dda($a) {
        dd($a->toArray());
    }
}