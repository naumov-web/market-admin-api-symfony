<?php

namespace App\Controller\Api;

use App\Services\ProductCategoryService;
use App\Traits\UseListRequestValidation;
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

    use UseListRequestValidation;

    /**
     * Sortable fields for getting of items
     * @var array
     */
    public const LIST_SORTABLE_FIELDS = [
        'id',
        'name'
    ];

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

    /**
     * Get product categories list
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $rules = $this->getListDefaultValidationRules(self::LIST_SORTABLE_FIELDS);
        $parameters = $this->transformParameterTypes($request->query->all());
        $errors = $this->validator->validate($parameters, $rules);

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        $items_dto = $this->product_category_service->index($parameters);

        return $this->itemsJson(
            $items_dto
        );
    }

    /**
     * Update product category
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $body = $this->getRequestBody($request, ['name']);
        $errors = $this->validator->validate($body, $this->getCreateRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        $product_category = $this->product_category_service->getById($id);

        if (!$product_category) {
            return $this->notFoundJson();
        }

        $this->product_category_service->update($product_category, $body);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * Delete product category
     *
     * @param int $id
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(int $id): JsonResponse
    {
        $product_category = $this->product_category_service->getById($id);

        if (!$product_category) {
            return $this->notFoundJson();
        }

        $this->product_category_service->delete($product_category);

        return $this->json(null, Response::HTTP_NO_CONTENT);
    }
}