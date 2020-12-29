<?php

namespace App\Service;

use App\Model\KecamatanSingleRequest;

class KecamatanService
{
	public function createKecamatanSingleRequest($id) : KecamatanSingleRequest
	{
		return new KecamatanSingleRequest($id);
	}
}