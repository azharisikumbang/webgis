<?php

namespace App\Exception;

use App\Model\ApiResponseProblem;
use Symfony\Component\HttpFoundation\Response;

final class ApiBadRequestException extends \Exception implements ApiExceptionInterface
{
	public function __construct($errors) 
	{
		parent::__construct(
			json_encode($errors), 
			Response::HTTP_BAD_REQUEST
		);
	}

}