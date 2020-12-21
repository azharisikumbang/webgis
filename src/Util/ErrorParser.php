<?php

namespace App\Util;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ErrorParser
{
	public static function parse(ConstraintViolationListInterface $errors) : array
	{
		$responseErrors = [];

		foreach ($errors as $error) {
			$responseErrors[] = [ 
				"property" => 
				$error->getPropertyPath(),
				"messages" => [ $error->getMessage() ] 
			];
		}

		return $responseErrors;
	}
}