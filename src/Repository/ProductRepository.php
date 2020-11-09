<?php

namespace App\Repository;

use App\DTO\IndexDTO;
use App\DTO\ListItemsDTO;
use App\Entity\Product;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductRepository
 * @package App\Repository
 */
final class ProductRepository extends BaseRepository
{
    /**
     * ProductRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Store model to database
     *
     * @param Product $product
     * @return Product|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(Product $product): ?Product
    {
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();

        return $product;
    }

}
