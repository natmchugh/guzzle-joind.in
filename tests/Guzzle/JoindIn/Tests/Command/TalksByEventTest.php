<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class TalksByEventTest extends GuzzleTestCase
{

    public function testTalksByEventTestRequest()
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
            'event_id' => 1000,
        );

        $command = $client->getCommand('TalksByEvent', $params);
        $this->setMockResponse($client, 'talks.by.event');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/events/1000/talks?format=json&resultsperpage=1&start=1&verbose=yes', $command->getRequest()->getUrl());
    }

    public function testTalksByEventTestResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');$client = 
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'resultsperpage' => 1,
            'start' => 1,
            'verbose' => 'yes',
            'event_id' => 1000,
        );

        $this->setMockResponse($client, 'talks.by.event');
        $response = $client->TalksByEvent($params);
        $talks = $response['talks'];
        $talk = array_pop($talks);
        $this->assertSame("Effective Code Reviews", $talk['talk_title']);
    }
}