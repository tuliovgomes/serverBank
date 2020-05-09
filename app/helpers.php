<?php

use Illuminate\Support\Str;

function custom_token($prefix = 'tk', $length = 40)
{
    $chars = $length - (strlen($prefix) + 1);

    return sprintf('%s_%s', $prefix, Str::random($chars));
}

function required_to_sometimes(array $rules)
{
    return collect($rules)->map(function ($rule, $key) {
        is_string($rule) ? $rule = str_replace('required', 'sometimes', $rule) : $rule[0] = 'sometimes';

        return $rule;
    })->toArray();
}

/**
 * only_numbers.
 *
 * Retorna somente números de uma string.
 *
 * @param string $string
 *
 * @return string
 */
function only_numbers($string)
{
    return preg_replace('/[^0-9]/', '', $string);
}

function decimal_to_cents($value)
{
    return (int) round($value * 100, 0);
}

function cents_to_decimal($value)
{
    return (float) $value / 100;
}

function ip()
{
    $request = app('request');
        
    if ($request->header('X-Forwarded-For')) {
        return $request->header('X-Forwarded-For');
    }

    return isset($_SERVER['HTTP_CF_CONNECTING_IP']) ? $_SERVER['HTTP_CF_CONNECTING_IP'] : $_SERVER['REMOTE_ADDR'];
}
