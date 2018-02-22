<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use Psr\Http\Message\RequestInterface;

abstract class Base extends Model
{
	/**
	 * Guzzle HTTP Client
	 *
	 * @var \GuzzleHttp\ClientInterface
	 */
	protected $httpClient;

	public function __construct(
		array $attributes = [],
		Client $httpClient
	)
	{
		parent::__construct($attributes);
		$this->httpClient = $httpClient;
	}

}
