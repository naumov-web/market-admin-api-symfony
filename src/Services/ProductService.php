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
    protected $product_repository;

    /**
     * ProductService constructor.
     * @param ProductRepository $product_repository
     */
    public function __construct(ProductRepository $product_repository)
    {
        $this->product_repository = $product_repository;
    }

    /**
     * Create product
     *
     * @param array $data
     * @return Product
     */
    public function create(array $data): Product
    {

    }

}