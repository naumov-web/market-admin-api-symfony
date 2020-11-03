<?php

namespace App\Services;

use App\Entity\Product;
use App\Repository\ProductRepository;

/**
 * Class ProductService
 * @package App\Services
 */
class ProductService
{

    /**
     * Product repository instance
     * @var ProductRepository
     */
    protected $repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create product
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {
        $product = new Product(
            $data['name'],
            $data['price'],
            $data['description'] ?? null
        );
        $product->setProductCategory($data['product_category']);

        $product = $this->repository->store($product);

        return $product;
    }

}