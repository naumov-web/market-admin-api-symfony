<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Class UserRepository
 * @package App\Repository
 */
final class UserRepository extends ServiceEntityRepository
{
    /**
     * UserRepository constructor.
     * @param ManagerRegistry $registry
     */
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Store user
     *
     * @param User $user
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(User $user): User
    {
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return $user;
    }

    /**
     * Get user by email
     *
     * @param string $email
     * @return User|null
     */
    public function getByEmail(string $email): ?User
    {
        /**
         * @var User $user
         */
        $user = $this->findOneBy([
            'email' => $email
        ]);

        return $user;
    }

    /**
     * Get user by email or phone
     *
     * @param string $email
     * @param string $phone
     * @return User|null
     */
    public function getByEmailOrPhone(string $email, string $phone): ?User
    {
        /**
         * @var User $user
         */
        $user = $this->createQueryBuilder('users')
            ->orWhere('users.email = :email')
            ->orWhere('users.phone = :phone')
            ->setParameter('email', $email)
            ->setParameter('phone', $phone)
            ->getQuery()
            ->execute();

        return $user[0] ?? null;
    }
}
