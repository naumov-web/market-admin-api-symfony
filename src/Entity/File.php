<?php

namespace App\Entity;

use App\Repository\FileRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FileRepository::class)
 * @ORM\Table(name="`files`")
 */
class File
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=2000)
     */
    private $path;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $mime;

    /**
     * File constructor.
     * @param string $name
     * @param string $path
     * @param string $mime
     */
    public function __construct(string $name, string $path, string $mime)
    {
        $this->name = $name;
        $this->path = $path;
        $this->mime = $mime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function getMime(): ?string
    {
        return $this->mime;
    }
}
