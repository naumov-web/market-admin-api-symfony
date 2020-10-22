<?php

namespace App\Controller\Api;

use App\Services\UserService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class UsersController
 * @package App\Controller\Api
 */
final class UsersController extends BaseApiController
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
     * UsersController constructor.
     * @param ValidatorInterface $validator
     * @param UserService $user_service
     */
    public function __construct(ValidatorInterface $validator, UserService $user_service)
    {
        $this->validator = $validator;
        $this->user_service = $user_service;
    }

    /**
     * Get validation rules for create
     *
     * @return Assert\Collection
     */
    protected function getCreateRules(): Assert\Collection
    {
        return new Assert\Collection([
            'name' => new Assert\Optional(new Assert\Type(['type' => 'string'])),
            'email' => [new Assert\NotBlank(), new Assert\Email()],
            'phone' => new Assert\NotBlank(),
            'password' => new Assert\NotBlank()
        ]);
    }

    /**
     * Create user
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function create(Request $request): JsonResponse
    {
        $body = $this->getRequestBody($request);
        $errors = $this->validator->validate($body, $this->getCreateRules());

        if (count($errors) > 0) {
            return $this->errorsJson($errors);
        }

        if ($this->user_service->getByEmailOrPhone($body['email'], $body['phone'])) {
            throw new \LogicException('User already exists!');
        }

        $this->user_service->create(
            $body['email'],
            $body['phone'],
            $body['password'],
            $body['name']
        );

        return $this->json([
            'success' => true
        ], Response::HTTP_CREATED);
    }

}