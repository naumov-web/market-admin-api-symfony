<?php

namespace App\Utils;

/**
 * Class CircularReferenceHandler
 * @package App\Utils
 */
class CircularReferenceHandler
{
    /**
     * Handle event
     *
     * @param $object
     * @return mixed
     */
    public function __invoke($object)
    {
        $result = [
            'id' => $object->getId()
        ];

        if (method_exists($object, 'getName')) {
            $result['name'] = $object->getName();
        }

        return $result;
    }
}