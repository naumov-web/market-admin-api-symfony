<?php

namespace App\Repository;

use App\Entity\ProductParameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class ProductParameterRepository
 * @package App\Repository
 */
final class ProductParameterRepository extends ServiceEntityRepository
{
    /**
     * ProductParameterRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductParameter::class);
    }

}
