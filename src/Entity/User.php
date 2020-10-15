<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @ORM\Table(name="`users`")
 */
final class User implements UserInterface
{

    /**
     * Password salt
     * @var string
     */
    public const PASSWORD_SALT = '!kRcR@RtOXYf0vun*Qx81E@DM';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="users_id_seq", initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=500, nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $name;

    /**
     * User constructor.
     * @param string $email
     * @param string $phone
     */
    public function __construct(string $email, string $phone)
    {
        $this->email = $email;
        $this->phone = $phone;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getRoles()
    {
        return [];
    }

    /**
     * @inheritDoc
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return self::PASSWORD_SALT;
    }

    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->email;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }
}