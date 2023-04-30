<?php

namespace Container\Interfaces;

interface IContainerInterface
{
    public function add(string $id, mixed $value): IEntityInterface;
}
