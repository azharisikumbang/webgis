<?php

namespace App\Http;

class ApiOkResponse extends ApiResponse
{

	public $data;

	public function __construct(
		$code,
		$status,
		$data
	) {
		parent::__construct($code, $status, $data);
		$this->data = $data;
	}

}