<?php

namespace App\Models\Interfaces;


interface PostInterface
{
    public function updateSlug(array $data): array;
    /**
     * @return array
     */
    public function getContents();

    /**
     * @param array $contents
     * @return void
     */
    public function saveContents(array $contents);
}