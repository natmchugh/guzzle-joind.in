<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class UserDetailTests extends GuzzleTestCase
{
    public function testUserDetailTestRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'verbose' => 'yes',
            'user_id' => 793,
        );

        $command = $client->getCommand('UserDetail', $params);
        $this->setMockResponse($client, 'user.detail');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/v2.1/users/793?format=json&verbose=yes',
            $command->getRequest()->getUrl()
        );
    }


    public function testUserDetailTestResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');$client = 
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
            'verbose' => 'yes',
            'event_id' => 793,
        );

        $this->setMockResponse($client, 'user.detail');
        $response = $client->TalksByEvent($params);
        $users = $response['users'];
        $user = array_pop($users);
        $this->assertSame("Nathaniel McHugh", $user['full_name']);
    }
}