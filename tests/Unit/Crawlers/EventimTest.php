<?php

namespace Tests\Unit;

use App\Crawlers\Eventim;
use GuzzleHttp\Client;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventimTest extends TestCase
{
	private $crawler;

	public function setUp()
	{
		$client = new Client;
		$this->crawler = new Eventim([], $client);
	}
	/**
	 * Test general connection to Eventim
	 *
	 * @return void
	 */
	public function testEventimCanBeReached()
	{
		$response = $this->crawler->getClient()->request('GET', 'http://www.eventim.de/yung-hurn-aachen-tickets.html?affiliate=EYA&doc=artistPages%2Ftickets&fun=artist&action=tickets&key=2078585%2410513338&jumpIn=yTix');
		$this->assertEquals(
			200,
			$response->getStatusCode()
		);
	}

	public function testEventCanBeFound()
	{
		$response = $this->crawler->getClient()->request('GET', 'http://www.eventim.de/yung-hurn-aachen-tickets.html?affiliate=EYA&doc=artistPages%2Ftickets&fun=artist&action=tickets&key=2078585%2410513338&jumpIn=yTix');
		$event = $this->crawler->getEventData($response);
		$this->assertEquals(
			'Yung Hurn',
			$event->getName()
		);
		$this->markTestIncomplete();
	}

	public function testNumberOfTicketsCanBeAvailable()
	{
		$this->markTestIncomplete();
	}

	public function testFansaleTicketsOfEventCanBeFound()
	{
		$this->markTestIncomplete();
	}

	public function testFansaleTicketsOfEventAreAvailable()
	{
		$this->markTestIncomplete();
	}
}
