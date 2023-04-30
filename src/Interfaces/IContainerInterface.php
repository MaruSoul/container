<?php

namespace Container\Interfaces;

interface IContainerInterface
{
    /**
     * @throws ServiceNotFoundException
     */
    public function add(string $id, mixed $value): IEntityInterface;

    public function getByTag(string $tag): array;
}
