<?php

namespace App\Services;

use App\DTO\IndexDTO;
use App\DTO\ListItemsDTO;
use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Services\Traits\UseDefaultServiceMethods;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

/**
 * Class ProductCategoryService
 * @package App\Services
 */
final class ProductCategoryService
{

    use UseDefaultServiceMethods;

    /**
     * Product category repository instance
     * @var ProductCategoryRepository
     */
    protected $repository;

    /**
     * ProductCategoryService constructor.
     * @param ProductCategoryRepository $repository
     */
    public function __construct(ProductCategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Create product category
     *
     * @param string $name
     * @return ProductCategory
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(string $name): ProductCategory
    {
        $category = new ProductCategory($name);

        $category = $this->repository->store($category);

        return $category;
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

    /**
     * Update product category
     *
     * @param ProductCategory $category
     * @param array $fields
     * @return ProductCategory
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(ProductCategory $category, array $fields): ProductCategory
    {
        $category->fill($fields);

        return $this->repository->store($category);
    }

}