<?php

namespace App\Message;

use App\Entity\User;

/**
 * Class CreateUser
 * @package App\Message
 */
class CreateUser
{

    /**
     * User entity
     * @var User
     */
    private $user;

    /**
     * CreateUser constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user instance
     *
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

}