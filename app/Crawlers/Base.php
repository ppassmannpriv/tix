<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\ClientInterface;
use Psr\Http\Message\RequestInterface;

abstract class Base extends Model implements ClientInterface
{
	/**
	 * Send an HTTP request.
	 *
	 * @param RequestInterface $request Request to send
	 * @param array            $options Request options to apply to the given
	 *                                  request and to the transfer.
	 *
	 * @return ResponseInterface
	 * @throws GuzzleException
	 */
	public function send(RequestInterface $request, array $options = [])
	{
		parent::send($request, $options);
	}

	/**
	 * Asynchronously send an HTTP request.
	 *
	 * @param RequestInterface $request Request to send
	 * @param array            $options Request options to apply to the given
	 *                                  request and to the transfer.
	 *
	 * @return PromiseInterface
	 */
	public function sendAsync(RequestInterface $request, array $options = [])
	{
		parent::send($request, $options);
	}

	/**
	 * Create and send an HTTP request.
	 *
	 * Use an absolute path to override the base path of the client, or a
	 * relative path to append to the base path of the client. The URL can
	 * contain the query string as well.
	 *
	 * @param string              $method  HTTP method.
	 * @param string|UriInterface $uri     URI object or string.
	 * @param array               $options Request options to apply.
	 *
	 * @return ResponseInterface
	 * @throws GuzzleException
	 */
	public function request($method, $uri, array $options = [])
	{
		parent::request($method, $uri, $options);
	}

	/**
	 * Create and send an asynchronous HTTP request.
	 *
	 * Use an absolute path to override the base path of the client, or a
	 * relative path to append to the base path of the client. The URL can
	 * contain the query string as well. Use an array to provide a URL
	 * template and additional variables to use in the URL template expansion.
	 *
	 * @param string              $method  HTTP method
	 * @param string|UriInterface $uri     URI object or string.
	 * @param array               $options Request options to apply.
	 *
	 * @return PromiseInterface
	 */
	public function requestAsync($method, $uri, array $options = [])
	{
		parent::requestAsync($method, $uri, $options);
	}

	/**
	 * Get a client configuration option.
	 *
	 * These options include default request options of the client, a "handler"
	 * (if utilized by the concrete client), and a "base_uri" if utilized by
	 * the concrete client.
	 *
	 * @param string|null $option The config option to retrieve.
	 *
	 * @return mixed
	 */
	public function getConfig($option = null)
	{
		parent::getConfig($option);
	}
}