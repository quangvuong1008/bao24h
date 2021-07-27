<?php

namespace App\Models\Forms;


use CodeIgniter\HTTP\Request;

abstract class BaseFormModel
{
    /**
     * @return array
     */
    abstract public function getRules(): array;

    /**
     * @param Request $request
     * @return bool
     */
    public function load(Request $request): bool
    {
        $this->setAttributes($request->getPost());
        return true;
    }

    /**
     * @param array $data
     */
    public function setAttributes(array $data)
    {
        $rules = array_keys($this->getRules());

        if (empty($rules)) return;

        foreach ($data as $attribute => $value) {
            if (!in_array($attribute, $rules)) continue;
            $this->$attribute = $value;
        }
    }
}