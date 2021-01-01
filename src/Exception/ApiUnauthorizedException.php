<?php

namespace App\Exception;

use Symfony\Component\HttpFoundation\Response;

final class ApiUnauthorizedException extends \Exception implements ApiExceptionInterface
{
	public function __construct($messages = null)
	{
		parent::__construct(
			$messages, 
			Response::HTTP_UNAUTHORIZED
		);
	}
} 