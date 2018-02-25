<?php declare(strict_types=1);

namespace App\Crawlers;

use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use Psr\Http\Message\RequestInterface;
use Psr\Log\InvalidArgumentException;

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

	/**
	 * This function parses the response to get the HTML/Body string
	 * @param Response $response
	 * @return string
	 */
	protected function parseResponse(Response $response) : string
	{
		$contents = '';
		try {
			$contents = $response->getBody()->getContents();
		} catch (InvalidArgumentException $e)
		{
			report($e);
		}

		return $contents;
	}

	/**
	 * Loads the HTML string as PHPHtmlParser\Dom Object
	 * @param string $string
	 * @return \PHPHtmlParser\Dom
	 */
	protected function getParsedHtml(string $string) : \PHPHtmlParser\Dom
	{
		try {
			$dom = $this->dom->load($string);
		} catch (InvalidArgumentException $e)
		{
			report($e);

			return $this->dom->load('');
		}
		return $dom;
	}

	protected function createEventDataArray(
		string $name,
		string $venue,
		string $location,
		int $timestamp,
		array $tickets
	)
	{
		return [
			'name' => $name,
			'venue' => $venue,
			'location' => $location,
			'timestamp' => $timestamp,
			'tickets' => $tickets
		];
	}

}
