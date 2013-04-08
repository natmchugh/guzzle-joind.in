<?php

namespace Guzzle\JoindIn\Tests;

use Guzzle\JoindIn\JoindInClient;

class JoindInClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testBuilderCreatesClient()
    {
        $client = JoindInClient::factory(array(
            'apikey' => $_SERVER['API_KEY']
        ));
    }
}