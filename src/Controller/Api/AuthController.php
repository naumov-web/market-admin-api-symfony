<?php

namespace App\Controller\Api;

use App\Services\UserService;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
     * JWT manager instance
     * @var JWTTokenManagerInterface
     */
    protected $jwt_manager;

    /**
     * AuthController constructor.
     * @param ValidatorInterface $validator
     * @param UserService $user_service
     * @param JWTTokenManagerInterface $jwt_manager
     */
    public function __construct(
        ValidatorInterface $validator,
        UserService $user_service,
        JWTTokenManagerInterface $jwt_manager
    )
    {
        $this->validator = $validator;
        $this->user_service = $user_service;
        $this->jwt_manager = $jwt_manager;
    }

    /**
     * Get validation rules for login
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

        $user = $this->user_service->getByCredentials($body['email'], $body['password']);

        if ($user) {
            return $this->json([
                'success' => true,
                'token' => $this->jwt_manager->create($user)
            ]);
        } else {
            return $this->json([
                'message' => 'Invalid email or password'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }

}