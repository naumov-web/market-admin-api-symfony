<?php

namespace App\Controller\Api;

use App\Services\UserService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class AuthController
 * @package App\Controller\Api
 */
final class AuthController extends BaseApiController
{

    /**
     * Validator instance
     * @var ValidatorInterface
     */
    protected $validator;

    /**
     * User service instance
     * @var UserService
     */
    protected $user_service;

    /**
     * AuthController constructor.
     * @param ValidatorInterface $validator
     * @param UserService $user_service
     */
    public function __construct(ValidatorInterface $validator, UserService $user_service)
    {
        $this->validator = $validator;
        $this->user_service = $user_service;
    }

    /**
     * Get validation rules
     *
     * @return Assert\Collection
     */
    protected function getLoginRules(): Assert\Collection
    {
        return new Assert\Collection([
            'email' => [new Assert\NotBlank(), new Assert\Email()],
            'password' => [new Assert\NotBlank()]
        ]);
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        $body = $this->getRequestBody($request, ['email', 'password']);
        $errors = $this->validator->validate($body, $this->getLoginRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        return $this->json([
            'success' => true
        ]);
    }

}