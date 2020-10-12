<?php

namespace App\Repository;

use App\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class FileRepository
 * @package App\Repository
 */
final class FileRepository extends ServiceEntityRepository
{
    /**
     * FileRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, File::class);
    }

}
