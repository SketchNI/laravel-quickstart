<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Json implements CastsAttributes
{
    /**
     * Retrieve and decode the requested JSON string.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return mixed
     */
    public function get($model, string $key, $value, array $attributes): object
    {
        return json_decode($value, false);
    }

    /**
     * Encode the given value into a JSON string.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string|bool
     */
    public function set($model, string $key, $value, array $attributes): string|bool
    {
        $flags = JSON_NUMERIC_CHECK | JSON_THROW_ON_ERROR | JSON_NUMERIC_CHECK | JSON_FORCE_OBJECT;
        return json_encode($value, $flags);
    }
}
