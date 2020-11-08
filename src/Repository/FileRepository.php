<?php

namespace App\Repository;

use App\Entity\File;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    /**
     * Store file model to database
     *
     * @param File $file
     * @return File
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(File $file): File
    {
        $this->getEntityManager()->persist($file);
        $this->getEntityManager()->flush();

        return $file;
    }

}
