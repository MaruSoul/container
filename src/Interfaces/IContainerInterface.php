<?php

namespace Container\Interfaces;

use Container\Exceptions\EntityNotFoundException;

interface IContainerInterface
{
    /**
     * @param string $id
     * @param mixed $value
     * @return IEntityInterface
     *@throws EntityNotFoundException
     */
    public function add(string $id, mixed $value): IEntityInterface;

    /**
     * @param string $tag
     * @return array
     */
    public function getByTag(string $tag): array;
}
