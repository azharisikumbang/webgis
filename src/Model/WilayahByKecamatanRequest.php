<?php

namespace App\Model;

use Symfony\Component\Validator\Constraints as Assert;

class WilayahByKecamatanRequest 
{
	/**
	* @Assert\NotBlank
	* @Assert\Type("string")
	*/
	public $kecamatan;

	public function __construct(string $kecamatan) 
	{
		$this->kecamatan = $kecamatan;
	}
}