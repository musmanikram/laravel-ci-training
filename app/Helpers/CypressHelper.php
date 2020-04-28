<?php

if (!function_exists('testAttribute')) {

    function testAttribute(string $value): string
    {
        return App::environment(['testing']) ? ' data-cy=' . $value : '';
    }
}

if (!function_exists('currentUser')) {

    function currentUser()
    {
        return auth()->user();
    }
}
