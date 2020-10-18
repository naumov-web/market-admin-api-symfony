<?php

namespace App\DTO;

/**
 * Class ListItemsDTO
 * @package App\DTO
 */
final class ListItemsDTO
{

    /**
     * Items array
     * @var array
     */
    private $items;

    /**
     * Items count
     * @var int
     */
    private $count;

    /**
     * ListItemsDTO constructor.
     * @param array $items
     * @param int $count
     */
    public function __construct(array $items, int $count)
    {
        $this->items = $items;
        $this->count = $count;
    }

    /**
     * Get items count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * Get items array
     *
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

}