<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;
use Teapot\StatusCode;

class AddANewTalkTest extends GuzzleTestCase
{

    public function testEventCommentsRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'event_id' => 1000,
            'talk_title' => 'Testing Guzzle Clients',
            'talk_description' => 'How to test guzzle clients',
            'start_date' => '2012-05-19T17:30:00+02:00',
        );

        $command = $client->getCommand('AddANewTalk', $params);
        $this->setMockResponse($client, 'post.new.talk');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/v2.1/events/1000/talks',
            $command->getRequest()->getUrl()
        );
        $requestJson  = '{"talk_title":"Testing Guzzle Clients",'.
        '"talk_description":"How to test guzzle clients",'.
        '"start_date":"2012-05-19T17:30:00+02:00"}';
         $this->assertContains(
            $requestJson,
            (string) $command->getRequest()
        );
    }

    public function testEventCommentsResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'event_id' => 1000,
            'talk_title' => 'Testing Guzzle Clients',
            'talk_description' => 'How to test guzzle clients',
            'start_date' => '2012-05-19T17:30:00+02:00',
        );

        $this->setMockResponse($client, 'post.new.talk');
        $response = $client->AddANewTalk($params);
        $this->assertSame($response->getStatusCode(), StatusCode::CREATED);
    }
}