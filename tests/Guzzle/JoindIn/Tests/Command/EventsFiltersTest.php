<?php

namespace Guzzle\JoindIn\Tests\Command;

use Guzzle\Tests\GuzzleTestCase;
use Guzzle\JoindIn\JoindInClient;
use Guzzle\Service\Description\ServiceDescription;

class EventFiltersTest extends GuzzleTestCase
{

    public function testEventFiltersRequest()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
        );

        $command = $client->getCommand('EventFilters', $params);
        $this->setMockResponse($client, 'event.filters');
        $response = $client->execute($command);
        $this->assertContains(
            'api.joind.in/?format=json',
            $command->getRequest()->getUrl()
        );
    }

    public function testEventFiltersResponse()
    {
        $configPath = __DIR__.'/../../../../../src/Guzzle/JoindIn/client.json';
        $description = ServiceDescription::factory($configPath);
        $client = $this->getServiceBuilder()->get('test.joind.in');
        $client->setDescription($description);
        $params = array(
            'format' => 'json',
        );

        $command = $client->getCommand('EventFilters', $params);
        $this->setMockResponse($client, 'event.filters');
        $links = $client->execute($command);
        $this->assertSame("http://test.api.joind.in/v2.1/events?filter=cfp", $links['open-cfps']);
    }
}