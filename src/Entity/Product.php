<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductRepository::class)
 * @ORM\Table(name="`products`")
 */
class Product
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="float", nullable=false)
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity=ProductCategory::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_category;

    /**
     * @ORM\ManyToMany(targetEntity=File::class)
     * @ORM\JoinTable(name="product_files")
     */
    private $files;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getProductCategory(): ?ProductCategory
    {
        return $this->product_category;
    }

    public function setProductCategory(ProductCategory $product_category): self
    {
        $this->product_category = $product_category;

        return $this;
    }
}
