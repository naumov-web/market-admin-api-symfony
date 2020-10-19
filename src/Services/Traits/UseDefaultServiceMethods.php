<?php

namespace App\Services\Traits;

/**
 * Trait UseDefaultServiceMethods
 * @package App\Services\Traits
 */
trait UseDefaultServiceMethods
{

    /**
     * Get model by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

}