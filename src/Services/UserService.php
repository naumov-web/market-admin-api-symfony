<?php

namespace App\Services;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserService
 * @package App\Services
 */
final class UserService
{

    /**
     * User repository instance
     * @var UserRepository
     */
    protected $repository;

    protected $password_encoder;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $password_encoder
     */
    public function __construct(UserRepository $repository, UserPasswordEncoderInterface $password_encoder)
    {
        $this->repository = $repository;
        $this->password_encoder = $password_encoder;
    }

    /**
     * Create user and store it to database
     *
     * @param string $email
     * @param string $phone
     * @param string $password
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $email, string $phone, string $password): User
    {
        $user = new User($email, $phone);
        $user->setPassword($this->password_encoder->encodePassword($user, $password));

        $user = $this->repository->store($user);

        return $user;
    }

    /**
     * Get user by credentials
     *
     * @param string $email
     * @param string $password
     * @return User|null
     */
    public function getByCredentials(string $email, string $password): ?User
    {
        $user = $this->repository->getByEmail($email);

        if ($user && $this->password_encoder->isPasswordValid($user, $password)) {
            return $user;
        }

        return null;
    }

}