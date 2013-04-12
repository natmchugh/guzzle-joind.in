<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class TalksDetailsTest extends GuzzleTestCase
{

    public function testTalksByEventTestRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'verbose' => 'yes',
            'talk_id' => 7056,
        );

        $command = $client->getCommand('TalkDetails', $params);
        $this->setMockResponse($client, 'talk.detail');
        $response = $client->execute($command);
        $this->assertContains('api.joind.in/v2.1/talks/7056?format=json&verbose=yes', $command->getRequest()->getUrl());
    }

    public function testTalksByEventTestResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');$client = 
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'verbose' => 'yes',
            'talk_id' => 7056,
        );

        $this->setMockResponse($client, 'talk.detail');
        $response = $client->TalkDetails($params);
        $talks = $response['talks'];
        $talk = array_pop($talks);
        $this->assertSame("Sebastian Marek", $talk['speakers'][0]['speaker_name']);
    }
}