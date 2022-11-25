<?php

namespace App\Traits;


trait TestTrait
{
    public function get($model)
    {
        return $model::all();
    }
}