<?php

namespace App\Models\Interfaces;


interface ImageAssetInterface
{
    /**
     * @return string
     */
    public function getImage(): string;
}