<?php declare(strict_types=1);

namespace App\Crawlers;

use Faker\Provider\DateTime;
use GuzzleHttp\Psr7\Response;
use Illuminate\Database\Eloquent\Model;
use PHPHtmlParser\Dom;

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
		$tickets = $this->getTickets($html);
		$eventData = $this->createEventDataArray(
			$html->find('#teaserHeadline')[0]->innerHtml,
			$venue,
			$location,
			$dateTime->getTimestamp(),
			$tickets[0]
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

	private function getTickets(Dom $html)
	{
		$tickets = [];
		foreach($html->find('#tableAssortmentList_yTix tbody tr') as $row)
		{
			$tickets[] = [
				'category' => trim($row->find('.catNumber')[0]->innerHtml),
				'description' => $row->find('.priceCategory')[0]->innerHtml,
				'price' => $row->find('.discountLevel')[0]->innerHtml,
				'qty' => $this->getQty($row),
				'available' => $this->getAvailability($row)
			];
		}

		return $tickets;
	}

	private function getQty($row)
	{
		if($row->find('.availability')[0]->innerHtml)
		{

		}
		return strip_tags(str_replace('&nbsp;', '', $row->find('.availability')[0]->innerHtml));
	}

	private function getAvailability($row)
	{
		if($row->find('.availability')[0]->innerHtml)
		{

		}
		return strip_tags(str_replace('&nbsp;', '', $row->find('.availability')[0]->innerHtml));
	}
}
