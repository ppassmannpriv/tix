<?php

namespace App\Base;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	protected $baseUrl = 'http://127.0.0.1:8080/blog/public/tickets/';

    public function getBaseUrl()
	{
		return $this->baseUrl;
	}tar
}
