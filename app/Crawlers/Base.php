<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use Psr\Http\Message\RequestInterface;

abstract class Base extends Model
{
	/**
	 * Guzzle HTTP Client
	 *
	 * @var \GuzzleHttp\ClientInterface
	 */
	protected $httpClient;

	/**
	 * PHPHtmlParser Dom
	 *
	 * @var \PHPHtmlParser\Dom
	 */
	protected $dom;

	public function __construct(
		array $attributes = [],
		Client $httpClient,
		Dom $dom
	)
	{
		parent::__construct($attributes);
		$this->httpClient = $httpClient;
		$this->dom = $dom;
	}

}
