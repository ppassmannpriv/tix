<?php
declare(strict_types=1);

namespace App\Base;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
	protected $baseUrl = 'http://127.0.0.1:8080/blog/public/';

	public function getFrontendConfig() : array
	{
		return [
			'baseUrl' => $this->baseUrl
		];
	}

    public function getBaseUrl() : string
	{
		return $this->baseUrl;
	}

	public function getNavigation() : array
	{
		return [
			'Home' => $this->getBaseUrl(),
			'Tickets' => $this->getBaseUrl().'tickets/'
		];
	}
}
