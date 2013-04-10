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
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'event_id' => 1000,
            'verbose' => 'yes',
            'format' => 'json'
        );

        $command = $client->getCommand('EventDetail', $params);
        $this->setMockResponse($client, 'event.detail');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/events/1000?apikey=secret_key&format=json&verbose=yes', $command->getRequest()->getUrl());
    }

    public function testEventDetailResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');$client = 
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