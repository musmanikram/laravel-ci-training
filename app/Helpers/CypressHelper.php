<?php

if (!function_exists('testAttribute')) {
    function testAttribute($value)
    {
        return App::environment(['dev']) ? ' data-cy="'.$value.'"' : '';
    }
}
