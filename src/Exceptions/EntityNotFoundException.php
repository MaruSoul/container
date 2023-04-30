<?php

namespace Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

class EntityNotFoundException extends Exception implements NotFoundExceptionInterface
{
    /**
     * @param string $idEntity
     */
	public function __construct(protected string $idEntity)
	{
		parent::__construct('Don\'t found entity with id: '. $this->idEntity);
	}

    /**
	 * @return string
	 */
	public function getIdService(): string
	{
		return $this->idEntity;
	}
}