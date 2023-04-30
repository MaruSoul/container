<?php

namespace Container\Interfaces;

interface IEntityInterface
{
    public function getTags(): array;
    public function addTag(string $tag): IEntityInterface;
    public function get(): mixed;
}
