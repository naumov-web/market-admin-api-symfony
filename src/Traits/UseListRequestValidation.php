<?php

namespace App\Traits;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Trait UseListRequestValidation
 * @package App\Traits
 */
trait UseListRequestValidation
{

    /**
     * Get list default validation rules
     *
     * @param array $sortable_fields
     * @param array $custom_rules
     * @return Assert\Collection
     */
    protected function getListDefaultValidationRules(
        array $sortable_fields = ['id'],
        array $custom_rules = []
    ): Assert\Collection
    {
        return new Assert\Collection(
            array_merge(
                [
                    'limit' => new Assert\Optional(new Assert\Type(['type' => 'integer'])),
                    'offset' => new Assert\Optional(new Assert\Type(['type' => 'integer'])),
                    'sort_by' => new Assert\Optional(
                        [new Assert\Type(['type' => 'string']), new Assert\Choice($sortable_fields)]
                    ),
                    'sort_direction' => new Assert\Optional(
                        [new Assert\Type(['type' => 'string']), new Assert\Choice(['asc', 'desc'])]
                    )
                ],
                $custom_rules
            )
        );
    }

}