<?php

namespace App\Controller\Api;

use App\Services\ProductCategoryService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ProductCategoriesController
 * @package App\Controller\Api
 */
final class ProductCategoriesController extends BaseApiController
{

    /**
     * Validator instance
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Product category service instance
     * @var ProductCategoryService
     */
    protected $product_category_service;

    /**
     * ProductCategoriesController constructor.
     * @param ValidatorInterface $validator
     * @param ProductCategoryService $product_category_service
     */
    public function __construct(ValidatorInterface $validator, ProductCategoryService $product_category_service)
    {
        $this->validator = $validator;
        $this->product_category_service = $product_category_service;
    }

    /**
     * Get validation rules for create
     *
     * @return Assert\Collection
     */
    protected function getCreateRules(): Assert\Collection
    {
        return new Assert\Collection([
            'name' => [new Assert\NotBlank()],
        ]);
    }

    /**
     * Create product category
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request): JsonResponse
    {
        $body = $this->getRequestBody($request, ['name']);
        $errors = $this->validator->validate($body, $this->getCreateRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        $this->product_category_service->create($body['name']);

        return $this->json([
            'success' => true
        ], Response::HTTP_CREATED);
    }
}