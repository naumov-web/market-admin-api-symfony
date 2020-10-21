<?php

namespace App\Controller\Api;

use App\Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class UsersController
 * @package App\Controller\Api
 */
final class UsersController extends BaseApiController
{

    /**
     * User service instance
     * @var UserService
     */
    protected $user_service;

    /**
     * UsersController constructor.
     * @param UserService $user_service
     */
    public function __construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    /**
     * Create user
     * 
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        return $this->json([
            'success' => true
        ], Response::HTTP_CREATED);
    }

}