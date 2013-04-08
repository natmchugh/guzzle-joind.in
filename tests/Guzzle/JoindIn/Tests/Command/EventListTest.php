<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class EventListTest extends GuzzleTestCase
{
    public function testGetEventsRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = new JoindInClient();
        $client->setDescription($description);

        $command = $client->getCommand('getEvents');
        $this->setMockResponse($client, 'events.list');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1', $command->getRequest()->getUrl());
    }

    public function testGetEventsResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = new JoindInClient();
        $client->setDescription($description);

        $this->setMockResponse($client, 'events.list');
        $response = $client->getEvents();
        $this->assertSame($response['meta']['count'], 1);

        $events = $response['events'];
        $event = current($events);
        $this->assertSame($event['name'], "GeekyConf: Explore, Learn & Enjoy");
    }
}