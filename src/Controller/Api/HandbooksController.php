<?php

namespace App\Controller\Api;

use App\Services\HandbooksService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class HandbooksController
 * @package App\Controller\Api
 */
final class HandbooksController extends BaseApiController
{

    /**
     * Handbooks service instance
     * @var HandbooksService
     */
    protected $handbooks_service;

    /**
     * HandbooksController constructor.
     * @param HandbooksService $handbooks_service
     */
    public function __construct(HandbooksService $handbooks_service)
    {
        $this->handbooks_service = $handbooks_service;
    }

    /**
     * Get all handbooks
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function indexAll(Request $request): JsonResponse
    {
        return $this->json([
            'product_parameters' => $this->handbooks_service->getProductParameterTypes()
        ]);
    }

}