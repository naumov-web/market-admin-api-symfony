<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * Class BaseApiController
 * @package App\Controller\Api
 */
abstract class BaseApiController extends AbstractController
{

    /**
     * Get request body
     *
     * @param Request $request
     * @param array $fields
     * @return array
     */
    protected function getRequestBody(Request $request, array $fields = []): array
    {
        if (0 === strpos($request->headers->get('Content-Type'), 'application/json')) {
            $data = json_decode($request->getContent(), $assoc = true);

            if (count($fields) > 0) {
                foreach ($data as $key => $data_item) {
                    if (!in_array($key, $fields)) {
                        unset($data[$key]);
                    }
                }
            }

            return $data;
        }

        return [];
    }

    /**
     * Render json with errors
     *
     * @param ConstraintViolationListInterface $errors
     * @return JsonResponse
     */
    protected function errorsJson(ConstraintViolationListInterface $errors): JsonResponse
    {
        $errors_list = [];

        foreach ($errors as $error) {
            /**
             * @var ConstraintViolation $error
             */
            $property = $this->getPropertyName($error);

            if ($property) {
                $errors_list[$property][] = $error->getMessage();
            }
        }

        return $this->json([
            'errors' => $errors_list
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Get property name
     *
     * @param ConstraintViolation $error
     * @return string
     */
    protected function getPropertyName(ConstraintViolation $error): ?string
    {
        $property_path = $error->getPropertyPath();

        return str_replace(
            ['[', ']'],
            '',
            $property_path
        );
    }

}