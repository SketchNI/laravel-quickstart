<?php

namespace App\Casts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt as CryptFacade;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class Crypt implements CastsAttributes
{
    /**
     * Retrieve and decrypt the requested value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string|object
     */
    public function get($model, string $key, $value, array $attributes): string|object
    {
        return CryptFacade::decrypt($value);
    }

    /**
     * Encrypt the given value.
     *
     * @param  Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, string $key, $value, array $attributes): string
    {
        return CryptFacade::encrypt($value);
    }
}
