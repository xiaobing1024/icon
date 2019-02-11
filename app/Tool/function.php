<?php

if (!function_exists('cache_map')) {
    function cache_map($k, $d = null)
    {
        $maps = cache('map', []);
        return array_key_exists($k, $maps) ? $maps[$k] : $d;
    }
}

if (!function_exists('dda')) {
    function dda($a)
    {
        dd($a->toArray());
    }
}


if (!function_exists('combination')) {
    function combination($a, $m)
    {
        $r = [];

        $n = count($a);
        if ($m <= 0 || $m > $n) {
            return $r;
        }

        for ($i = 0; $i < $n; $i++) {
            $t = [$a[$i]];
            if ($m == 1) {
                $r[] = $t;
            } else {
                $b = array_slice($a, $i + 1);
                $c = combination($b, $m - 1);
                foreach ($c as $v) {
                    $r[] = array_merge($t, $v);
                }
            }
        }

        return $r;
    }
}