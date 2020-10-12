<?php

namespace App\Repository;

use App\Entity\ProductParameterValue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductParameterValueRepository
 * @package App\Repository
 */
final class ProductParameterValueRepository extends ServiceEntityRepository
{
    /**
     * ProductParameterValueRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductParameterValue::class);
    }
}
