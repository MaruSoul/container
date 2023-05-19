<?php

namespace Container\Interfaces;

use Container\Exceptions\EntityNotFoundException;

interface ContainerInterface
{
    /**
     * @param string $id
     * @param mixed $value
     * @return EntityInterface
     *@throws EntityNotFoundException
     */
    public function add(string $id, mixed $value): EntityInterface;

    /**
     * @param string $tag
     * @return array
     */
    public function getByTag(string $tag): array;
}
