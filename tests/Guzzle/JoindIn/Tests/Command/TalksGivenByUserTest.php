<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class TalksGivenByUserTest extends GuzzleTestCase
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
            'start' => 0,
            'verbose' => 'yes',
            'user_id' => 793,
        );

        $command = $client->getCommand('TalksGivenByUser', $params);
        $this->setMockResponse($client, 'talks.by.user');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/users/793/talks?format=json&resultsperpage=1&start=0&verbose=yes', $command->getRequest()->getUrl());
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
            'start' => 0,
            'verbose' => 'yes',
            'user_id' => 793,
        );

        $this->setMockResponse($client, 'talks.by.user');
        $response = $client->TalksGivenByUser($params);
        $talks = $response['talks'];
        $talk = array_pop($talks);
        $this->assertSame("Fork it! Parallel processing in PHP", $talk['talk_title']);
    }
}