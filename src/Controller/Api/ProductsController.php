<?php

namespace App\Controller\Api;

use App\Services\ProductCategoryService;
use App\Services\ProductService;
use App\Traits\UseListRequestValidation;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
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

    use UseListRequestValidation;

    /**
     * Sortable fields for getting of items
     * @var array
     */
    public const LIST_SORTABLE_FIELDS = [
        'id',
        'name',
        'price'
    ];

    /**
     * Validator instance
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * Products service instance
     * @var ProductService
     */
    protected $product_service;

    /**
     * Product categories service instance
     * @var ProductCategoryService
     */
    protected $product_category_service;

    /**
     * ProductsController constructor.
     * @param ValidatorInterface $validator
     * @param ProductService $products_service
     */
    public function __construct(
        ValidatorInterface $validator,
        ProductService $products_service,
        ProductCategoryService $product_category_service
    )
    {
        $this->validator = $validator;
        $this->product_service = $products_service;
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
            'description' => new Assert\Optional(new Assert\Type(['type' => 'string'])),
            'product_category_id' => [new Assert\NotBlank(), new Assert\Type(['type' => 'integer'])],
            'price' => [new Assert\NotBlank(), new Assert\Type(['type' => 'float'])],
            'files' => new Assert\Optional()
        ]);
    }

    /**
     * Create product
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request): JsonResponse
    {
        $body = $this->getRequestBody($request, ['name', 'description', 'product_category_id', 'price', 'files']);
        $errors = $this->validator->validate($body, $this->getCreateRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        $product_category = $this->product_category_service->getById($body['product_category_id']);

        if (!$product_category) {
            throw new \LogicException('Product category not found!');
        }

        $this->product_service->create(
            array_merge(
                $body,
                [
                    'product_category' => $product_category
                ]
            )
        );

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

        $items_dto = $this->product_service->index($parameters);

        return $this->itemsJson(
            $items_dto
        );
    }

}