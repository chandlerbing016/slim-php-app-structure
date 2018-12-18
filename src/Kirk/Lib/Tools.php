<?php

namespace Kirk\Lib;

class Tools
{
    public static function validate(array $post)
    {
        return isset($post);
    }

    public static function rotate_id(int $id)
    {
        return (((0x0000FFFF & $id) << 16) + ((0xFFFF0000 & $id) >> 16));
    }
}