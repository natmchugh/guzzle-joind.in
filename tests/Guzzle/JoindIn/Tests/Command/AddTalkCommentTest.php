<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;
use Teapot\StatusCode;

class AddTalkCommentTest extends GuzzleTestCase
{

    public function testEventCommentsRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'talk_id' => 1000,
            'rating' => 5,
            'comment' => 'Best talk ever talk.',
        );

        $command = $client->getCommand('AddTalkComment', $params);
        $this->setMockResponse($client, 'post.talk.comment');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/v2.1/talks/1000/comments',
            $command->getRequest()->getUrl()
        );
        $requestJson = '{"rating":5,"comment":"Best talk ever talk."}';

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
            'talk_id' => 1000,
            'rating' => 5,
            'comment' => 'Best talk ever talk.',
        );

        $this->setMockResponse($client, 'post.talk.comment');
        $response = $client->AddTalkComment($params);
        $this->assertSame($response->getStatusCode(), StatusCode::CREATED);
    }
}