<?php

namespace App\Repository;

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
}
