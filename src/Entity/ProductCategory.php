<?php

namespace App\Entity;

use App\Entity\Traits\UseDefaultEntityMethods;
use App\Repository\ProductCategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductCategoryRepository::class)
 * @ORM\Table(name="`product_categories`")
 */
class ProductCategory
{

    use UseDefaultEntityMethods;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="product_categories_id_seq", initialValue=1)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="product_category")
     */
    private $products;

    /**
     * Get product category id
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get product category name
     *
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set product category name
     *
     * @param string $name
     * @return $this
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * ProductCategory constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->products = new ArrayCollection();
    }

    /**
     * Get collection with products
     *
     * @return Collection|Product[]
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }
}
