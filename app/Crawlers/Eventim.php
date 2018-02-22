<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;

class Eventim extends Base
{
	public function getClient()
	{
		return $this->httpClient;
	}
}
