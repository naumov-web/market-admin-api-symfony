<?php

namespace App\Repository;

use App\DTO\IndexDTO;
use App\DTO\ListItemsDTO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * Class BaseRepository
 * @package App\Repository
 */
abstract class BaseRepository extends ServiceEntityRepository
{
    /**
     * Get product categories list
     *
     * @param IndexDTO $params
     * @return ListItemsDTO
     */
    public function index(IndexDTO $params): ListItemsDTO
    {
        $items = $this->findBy(
            $params->getFilters(),
            [
                $params->getSortBy() => $params->getSortDirection()
            ],
            $params->getLimit(),
            $params->getOffset()
        );

        $count = $this->count(
            $params->getFilters()
        );

        return new ListItemsDTO(
            $items,
            $count
        );
    }

    /**
     * Get first record by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->findOneBy([
            'id' => $id
        ]);
    }
}