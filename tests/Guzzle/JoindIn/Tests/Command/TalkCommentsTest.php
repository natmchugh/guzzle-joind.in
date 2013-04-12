<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class TalkCommentsTest extends GuzzleTestCase
{

    public function testEventCommentsRequest()
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
            'talk_id' => 7056,
        );

        $command = $client->getCommand('TalkComments', $params);
        $this->setMockResponse($client, 'talk.comments');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/v2.1/talks/7056/comments?format=json&resultsperpage=1&start=1&verbose=yes',
            $command->getRequest()->getUrl()
        );
    }

    public function testEventCommentsResponse()
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
            'talk_id' => 7056,
        );

        $this->setMockResponse($client, 'talk.comments');
        $response = $client->TalkComments($params);
        $comments = $response['comments'];
        $comment = array_pop($comments);
        $this->assertSame("Good concepts, well presented.", $comment['comment']);
    }
}