<?php

namespace Container\Exceptions;

use Exception;

class NotImplementRequiredInterfaceException extends Exception
{
    /**
	 * @param string $requiredInterface
	 */
	public function __construct(protected string $requiredInterface)
	{
		parent::__construct('Don\'t implement required interface: '. $this->requiredInterface);
	}

    /**
	 * @return string
	 */
	public function getRequiredInterface(): string
	{
		return $this->requiredInterface;
	}
}
