<?php

namespace App\Controller\Api;

use App\Services\ProductService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class ProductsController
 * @package App\Controller\Api
 */
final class ProductsController extends BaseApiController
{

    /**
     * Validator instance
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Products service instance
     * @var ProductService
     */
    protected $products_service;

    /**
     * ProductsController constructor.
     * @param ValidatorInterface $validator
     * @param ProductService $products_service
     */
    public function __construct(ValidatorInterface $validator, ProductService $products_service)
    {
        $this->validator = $validator;
        $this->products_service = $products_service;
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
     * Create product
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $body = $this->getRequestBody($request, ['name']);
        $errors = $this->validator->validate($body, $this->getCreateRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        return $this->json([
            'success' => true
        ], Response::HTTP_CREATED);
    }

}