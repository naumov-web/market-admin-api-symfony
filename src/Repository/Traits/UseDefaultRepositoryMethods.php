<?php

namespace App\Repository\Traits;

/**
 * Trait UseDefaultRepositoryMethods
 * @package App\Repository\Traits
 */
trait UseDefaultRepositoryMethods
{

    /**
     * Get first record by id
     *
     * @param int $id
     * @return mixed
     */
    public function getById(int $id)
    {
        return $this->findOneBy([
            'id' => $id
        ]);
    }

}