<?php

namespace Tests\Unit;

use App\Crawlers\Eventim;
use GuzzleHttp\Client;
use PHPHtmlParser\Dom;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EventimTest extends TestCase
{
	private $crawler;

	const VERSION = '0.0.1';

	public function setUp()
	{
		$client = new Client;
		$dom = new Dom;
		$this->crawler = new Eventim([], $client, $dom);
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
		$ticket = array(
			'category' => '1',
			'description' => 'Stehplatz',
			'price' => 'Normalpreis',
			'qty' => 0,
			'available' => 'zzt. nicht verfügbar'
		);
		$this->assertEquals(
			[
				'name' => 'Yung Hurn AACHEN - Tickets',
				'venue' => 'Musikbunker Aachen',
				'location' => 'Rehmannstr. 26, 52066 AACHEN',
				'timestamp' => 1523044800,
				'tickets' => $ticket
			],
			$event
		);
	}

	public function testNumberOfTicketsCanBeAvailable()
	{
		$response = $this->crawler->getClient()->request('GET', 'http://www.eventim.de/russell-peters-koeln-deutz-tickets.html?affiliate=EYA&doc=artistPages%2Ftickets&fun=artist&action=tickets&key=2119327%2410522399&jumpIn=yTix&kuid=549807&from=erdetaila');
		$event = $this->crawler->getEventData($response);
		$test = [
			'name' => "Russell Peters KÖLN (DEUTZ) - Tickets",
  			'venue' => "Theater am Tanzbrunnen",
  			'location' => "Rheinparkweg 1, 50679 KÖLN (DEUTZ)",
  			'timestamp' =>1525462200,
  			'tickets' => [
  				'category' => '1',
    			'description' => "Sitzplatz",
    			'price' => "Normalpreis",
    			'qty' => 3,
    			'available' => true
			]
		];
		$this->assertSame(
			3,
			$event['tickets']['qty']
		);
	}

	public function testFansaleTicketsOfEventCanBeFound()
	{
		$this->markTestIncomplete();
	}

	public function testFansaleTicketsOfEventAreAvailable()
	{
		$this->markTestIncomplete();
	}

	public function testIsLinkADirectEventOrAMultipleListing()
	{
		$this->markTestIncomplete();
	}
}
