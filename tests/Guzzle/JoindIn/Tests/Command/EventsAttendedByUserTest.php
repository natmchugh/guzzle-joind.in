<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class EventsAttendedByUserTest extends GuzzleTestCase
{
    public function testEventsAttendedByUserRequest()
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
            'user_id' => 793,
        );
        $command = $client->getCommand('EventsAttendedByUser', $params);
        $this->setMockResponse($client, 'events.by.user');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/users/793/attended?format=json&resultsperpage=1&start=1&verbose=yes', $command->getRequest()->getUrl());
    }

    public function testEventsAttendedByUserResponse()
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
            'user_id' => 793,
        );

        $this->setMockResponse($client, 'events.by.user');
        $response = $client->EventsAttendedByUser($params);
        $this->assertSame(1, $response['meta']['count']);

        $events = $response['events'];
        $event = array_pop($events);
        $this->assertSame("Dutch PHP Conference 2011", $event['name']);
    }
}