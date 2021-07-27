<?php

namespace App\Models\Interfaces;


interface ContentInterface
{
    /**
     * @param array $data
     * @return array
     */
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