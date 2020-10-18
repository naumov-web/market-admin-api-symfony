<?php

namespace App\DTO;

/**
 * Class IndexDTO
 * @package App\DTO
 */
final class IndexDTO
{

    /**
     * Limit value
     * @var int
     */
    private $limit = 100;

    /**
     * Offset value
     * @var int
     */
    private $offset = 0;

    /**
     * Filters array
     * @var array
     */
    private $filters = [];

    /**
     * Sort by column
     * @var string
     */
    private $sort_by = 'id';

    /**
     * Sort direction value
     * @var string
     */
    private $sort_direction = 'asc';

    /**
     * Mass assignment of object fields
     *
     * @param array $fields
     * @return IndexDTO
     */
    public function fill(array $fields): self
    {
        foreach ($fields as $field => $value) {
            $this->{$field} = $value;
        }

        return $this;
    }

    /**
     * Get offset value
     *
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * Get limit value
     *
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * Get sort direction value
     *
     * @return string
     */
    public function getSortDirection(): string
    {
        return $this->sort_direction;
    }

    /**
     * Get sort column
     *
     * @return string
     */
    public function getSortBy(): string
    {
        return $this->sort_by;
    }

    /**
     * Get array with filters
     *
     * @return array
     */
    public function getFilters(): array
    {
        return $this->filters;
    }
}