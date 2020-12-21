<?php

namespace App\Http;

class ApiResponse {

	public $code;

	public $status;

	public function __construct(
		$code,
		$status
	) {
		$this->code = $code;
		$this->status = $status;
	}

}