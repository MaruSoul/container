<?php

namespace Container\Interfaces;

interface EntityInterface
{
    /**
     * @return string[]
     */
    public function getTags(): array;

    /**
     * @param string $tag
     * @return EntityInterface
     */
    public function addTag(string $tag): EntityInterface;

    /**
     * @return mixed
     */
    public function get(): mixed;
}
