<?php

namespace App\Entity\Traits;

/**
 * Trait UseDefaultEntityMethods
 * @package App\Entity\Traits
 */
trait UseDefaultEntityMethods
{

    /**
     * Mass assignment of model fields
     *
     * @param array $fields
     * @return void
     */
    public function fill(array $fields): void
    {
        foreach ($fields as $field_name => $value) {
            $this->{$field_name} = $value;
        }
    }

}