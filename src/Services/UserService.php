<?php

namespace App\Services;

use App\Entity\User;
use App\Message\CreateUser;
use App\Repository\UserRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\Messenger\MessageBusInterface;
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

    /**
     * Password encoder instance
     * @var UserPasswordEncoderInterface
     */
    protected $password_encoder;

    /**
     * Message bus instance
     * @var MessageBusInterface
     */
    protected $message_bus;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     * @param UserPasswordEncoderInterface $password_encoder
     * @param MessageBusInterface $message_bus
     */
    public function __construct(
        UserRepository $repository,
        UserPasswordEncoderInterface $password_encoder,
        MessageBusInterface $message_bus
    )
    {
        $this->repository = $repository;
        $this->password_encoder = $password_encoder;
        $this->message_bus = $message_bus;
    }

    /**
     * Create user and store it to database
     *
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param string|null $name
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $email, string $phone, string $password, string $name = null): User
    {
        $user = new User($email, $phone);
        $user->setPassword($this->password_encoder->encodePassword($user, $password));

        if ($name) {
            $user->setName($name);
        }

        $user = $this->repository->store($user);

        $this->message_bus->dispatch(
            new CreateUser($user)
        );

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

    /**
     * Get user by email or phone
     *
     * @param string $email
     * @param string $phone
     * @return User|null
     */
    public function getByEmailOrPhone(string $email, string $phone): ?User
    {
        return $this->repository->getByEmailOrPhone($email, $phone);
    }

}