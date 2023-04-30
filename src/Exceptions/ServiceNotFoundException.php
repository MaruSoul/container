<?php

namespace Container\Exceptions;

use Psr\Container\NotFoundExceptionInterface;
use Exception;

class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{
    /**
	 * @param string $idService
	 */
	public function __construct(protected string $idService)
	{
		parent::__construct('Don\'t found service with id: '. $this->idService);
	}

    /**
	 * @return string
	 */
	public function getIdService()
	{
		return $this->idService;
	}
}