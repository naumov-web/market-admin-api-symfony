<?php

namespace App\Services;

use Symfony\Component\DependencyInjection\ParameterBag\ContainerBagInterface;

/**
 * Class HandbooksService
 * @package App\Services
 */
final class HandbooksService
{

    /**
     * Parameter types list
     * @var array
     */
    public const PARAMETER_TYPES = [
        [
            'id' => 1,
            'name' => 'Текст'
        ],
        [
            'id' => 2,
            'name' => 'Целое число'
        ],
        [
            'id' => 3,
            'name' => 'Вещественное число'
        ],
        [
            'id' => 4,
            'name' => 'Логическое значение'
        ],
        [
            'id' => 5,
            'name' => 'Многострочный текст'
        ],
    ];

    /**
     * Get product parameter types
     *
     * @return array
     */
    public function getProductParameterTypes(): array
    {
        return self::PARAMETER_TYPES;
    }

}