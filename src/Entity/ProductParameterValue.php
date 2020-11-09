<?php

namespace App\Entity;

use App\Repository\ProductParameterValueRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductParameterValueRepository::class)
 * @ORM\Table(name="`product_parameter_values`")
 */
class ProductParameterValue
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=1000, nullable=true)
     */
    private $value;

    /**
     * @ORM\ManyToOne(targetEntity=Product::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity=ProductParameter::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $product_parameter;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getProductParameter(): ?ProductParameter
    {
        return $this->product_parameter;
    }

    public function setProductParameter(ProductParameter $product_parameter): self
    {
        $this->product_parameter = $product_parameter;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): self
    {
        $this->product = $product;

        return $this;
    }
}
