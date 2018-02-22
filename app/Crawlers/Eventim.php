<?php

namespace App\Crawlers;

use Illuminate\Database\Eloquent\Model;

class Eventim extends Base
{
	public function getClient()
	{
		return $this->httpClient;
	}

	public function getEventData($response)
	{
		$dom = $this->dom->load($response->getBody()->getContents());

		return $dom->find('#teaserHeadline')[0]->innerHtml;
	}
}
