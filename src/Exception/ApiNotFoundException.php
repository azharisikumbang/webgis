<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

final class ApiNotFoundException extends \Exception implements ApiExceptionInterface
{
	public function __construct($messages = null)
	{
		parent::__construct(
			$messages, 
			Response::HTTP_NOT_FOUND
		);
	}
} 