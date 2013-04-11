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
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'resultsperpage' => 1,
            'start' => 1,
            'verbose' => 'yes',
            'filter' => 'hot',
        );
        $command = $client->getCommand('EventsList', $params);
        $this->setMockResponse($client, 'events.list');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/events?format=json&resultsperpage=1&start=1&verbose=yes&filter=hot', $command->getRequest()->getUrl());
    }

    public function testGetEventsResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);

        $this->setMockResponse($client, 'events.list');
        $response = $client->EventsList();
        $this->assertSame(1, $response['meta']['count']);

        $events = $response['events'];
        $event = array_pop($events);
        $this->assertSame("GeekyConf: Explore, Learn & Enjoy", $event['name']);
    }
}