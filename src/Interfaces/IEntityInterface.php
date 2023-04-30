<?php

namespace Container\Interfaces;

interface IEntityInterface
{
    /**
     * @return string[]
     */
    public function getTags(): array;

    /**
     * @param string $tag
     * @return IEntityInterface
     */
    public function addTag(string $tag): IEntityInterface;

    /**
     * @return mixed
     */
    public function get(): mixed;
}
