<?php

namespace App\Http;

class ApiProblemResponse extends ApiResponse {

	public $errors;

	public function __construct(
		$code,
		$status,
		$errors
	) {
		parent::__construct($code, $status);
		$this->errors = $errors;
	}

}