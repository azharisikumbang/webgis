<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class ChartByYearRequest
{
	/**
	* @Assert\NotBlank
	* @Assert\Type("numeric")
	* @Assert\GreaterThanOrEqual(2002)
	*/
	public string $year;

	public function __construct(string $year)
	{
		$this->year = $year;
	}
}