<?php

if (!function_exists('testAttribute')) {

    function testAttribute(string $value): string
    {
        return App::environment(['testing']) ? ' data-cy=' . $value : '';
    }
}
