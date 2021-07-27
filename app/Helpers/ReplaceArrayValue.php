<?php
namespace App\Helpers;

/**
 * Class ReplaceArrayValue
 * @package App\Helpers
 */
class ReplaceArrayValue
{
    /**
     * @var mixed value used as replacement.
     */
    public $value;


    /**
     * Constructor.
     * @param mixed $value value used as replacement.
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @param $state
     * @return ReplaceArrayValue
     * @throws \Exception
     */
    public static function __set_state($state)
    {
        if (!isset($state['value'])) {
            throw new \Exception('Failed to instantiate class "Instance". Required parameter "id" is missing');
        }

        return new self($state['value']);
    }
}
