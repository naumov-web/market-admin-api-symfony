<?php

namespace App\Repository;

use App\DTO\IndexDTO;
use App\DTO\ListItemsDTO;
use App\Entity\ProductCategory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductCategoryRepository
 * @package App\Repository
 */
final class ProductCategoryRepository extends ServiceEntityRepository
{
    /**
     * ProductCategoryRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductCategory::class);
    }

    /**
     * Store product category
     *
     * @param ProductCategory $category
     * @return ProductCategory
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(ProductCategory $category): ProductCategory
    {
        $this->getEntityManager()->persist($category);
        $this->getEntityManager()->flush();

        return $category;
    }

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
}
