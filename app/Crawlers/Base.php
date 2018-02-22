<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;

abstract class Base extends Model implements ClientInterface
{
	/**
	 * Guzzle HTTP Client
	 *
	 * @var \GuzzleHttp\ClientInterface
	 */
	protected $httpClient;

	public function __construct(
		array $attributes = [],
		ClientInterface $httpClient
	)
	{
		parent::__construct($attributes);
		$this->httpClient = $httpClient;
	}

}
