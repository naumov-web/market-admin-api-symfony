<?php

namespace App\Services;

use App\DTO\IndexDTO;
use App\DTO\ListItemsDTO;
use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class ProductService
 * @package App\Services
 */
final class ProductService
{

    /**
     * Product repository instance
     * @var ProductRepository
     */
    protected $repository;

    /**
     * File service instance
     * @var FileService
     */
    protected $file_service;

    /**
     * ProductService constructor.
     * @param ProductRepository $repository
     * @param FileService $file_service
     */
    public function __construct(ProductRepository $repository, FileService $file_service)
    {
        $this->repository = $repository;
        $this->file_service = $file_service;
    }

    /**
     * Create product
     *
     * @param array $data
     * @return Product
     * @throws ORMException
     * @throws OptimisticLockException
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

        if (isset($data['files'])) {
            $file_models = $this->file_service->createMultiple($data['files']);

            $product->setFiles(
                new ArrayCollection(
                    $file_models
                )
            );
        }

        return $product;
    }

    /**
     * Get product categories
     *
     * @param array $parameters
     * @return ListItemsDTO
     */
    public function index(array $parameters): ListItemsDTO
    {
        return $this->repository->index(
            (new IndexDTO())->fill($parameters)
        );
    }

}