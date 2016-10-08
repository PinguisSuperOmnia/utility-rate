<?php

class UtilityRate_Writer_Factory
{
    public static function getWriter($type)
    {
        $class = 'UtilityRate_Writer_' . ucfirst($type);
        return new $class;
    }
}
