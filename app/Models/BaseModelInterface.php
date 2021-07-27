<?php

namespace App\Models;


interface BaseModelInterface
{
    /**
     * @return array
     */
    public function getRules(): array;
}