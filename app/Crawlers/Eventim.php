<?php declare(strict_types=1);

namespace App\Crawlers;

use Faker\Provider\DateTime;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;

class Eventim extends Base
{
	public function getClient()
	{
		return $this->httpClient;
	}

	public function getEventData(Response $response)
	{
		$html = $this->getParsedHtml($this->parseResponse($response));
		$dateTime = \DateTime::createFromFormat('*, d.m.y, H:i *', $html->find('.ldt .ldtLocation .time')[0]->innerHtml);
		$venue = $this->cleanVenue($html->find('.ldt .location a')[0]->innerHtml);
		$location = $this->cleanLocation($venue, $html->find('.ldt .location')[0]->innerHtml);
		$eventData = $this->createEventDataArray(
			$html->find('#teaserHeadline')[0]->innerHtml,
			$venue,
			$location,
			$dateTime->getTimestamp()
	);
		return $eventData;
	}

	private function cleanVenue(string $input)
	{
		return strip_tags($input);
	}

	private function cleanLocation(string $remove, string $input)
	{
		return str_replace($remove, '', strip_tags($input));
	}
}
