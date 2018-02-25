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
		$eventData = false;
		if($html = $this->getParsedHtml($this->parseResponse($response)))
		{

			$dateTime = $this->parseDateTime($html->find('.time')[0]->innerHtml);
			$venue = $this->parseVenue($html->find('.location a')[0]->innerHtml);
			$location = $this->parseLocation($venue, $html->find('.location')[0]->innerHtml);
			$tickets = $this->parseTickets($html);
			if($dateTime && $venue && $location && $tickets) {
				$eventData = $this->createEventDataArray(
					$html->find('#teaserHeadline')[0]->innerHtml,
					$venue,
					$location,
					$dateTime->getTimestamp(),
					$tickets[0]
				);
			}

		}
		return $eventData;
	}

	private function parseDateTime(string $input)
	{
		return \DateTime::createFromFormat('*, d.m.y, H:i *', $input);
	}

	private function parseVenue(string $input)
	{
		return strip_tags($input);
	}

	private function parseLocation(string $remove, string $input)
	{
		return str_replace($remove, '', strip_tags($input));
	}

	private function parseTickets(Dom $html)
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
		if($this->getAvailability($row) === 'zzt. nicht verfügbar')
		{
			return 0;
		} else {
			$qty = (int)$row->find('select.cc-amount-selection')->lastChild()->innerHtml;
			return $qty;
		}

	}

	private function getAvailability(Dom\HtmlNode $row)
	{
		if($row->find('.availability')[0])
		{
			return strip_tags(str_replace('&nbsp;', '', $row->find('.availability')[0]->innerHtml));
		} else {
			return true;
		}
	}
}
