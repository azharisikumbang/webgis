<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class KecamatanSingleRequest
{
	/**
	* @Assert\Type("integer")
	* @Assert\PositiveOrZero
	*/	
	public $id;

	public function __construct($id)
	{
		$this->id = $id;
	}

}