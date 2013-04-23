<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class EventCommentsTest extends GuzzleTestCase
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
            'event_id' => 1000,
        );

        $command = $client->getCommand('EventComments', $params);
        $this->setMockResponse($client, 'event.comments');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/v2.1/events/1000/comments?format=json&resultsperpage=1&start=1&verbose=yes',
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
            'event_id' => 1000,
        );

        $this->setMockResponse($client, 'event.comments');
        $response = $client->EventComments($params);
        $comments = $response['comments'];
        $comment = array_pop($comments);
        $this->assertSame("http://test.api.joind.in/v2.1/event_comments/780", $comment['comment_uri']);
    }
}