<?php

namespace App\Traits;

trait ConvertString
{
    // remove space, convert the first character of every word in a string to upper-case
    protected function convert($str, $result = null)
    {
        if (!$str) return $result;

        return str_replace(' ', '', ucwords(str_replace('-', ' ', $str)));
    }
}
