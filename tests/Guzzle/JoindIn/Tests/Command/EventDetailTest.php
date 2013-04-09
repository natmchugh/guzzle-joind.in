<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class EventDetailTest extends GuzzleTestCase
{

    public function testEventDetailRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = new JoindInClient();
        $client->setDescription($description);

        $command = $client->getCommand('EventDetail', array('event_id' => 1000));
        $this->setMockResponse($client, 'event.detail');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/events/1000', $command->getRequest()->getUrl());
    }

    public function testEventDetailResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = new JoindInClient();
        $client->setDescription($description);

        $this->setMockResponse($client, 'event.detail');
        $response = $client->EventDetail(
            array('event_id' => 1000)
        );
        $events = $response['events'];
        $event = array_pop($events);
        $this->assertSame("Symfony Live London 2012", $event['name']);
    }
}