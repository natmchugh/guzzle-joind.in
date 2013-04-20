<?php

namespace Guzzle\JoindIn\Tests;

use Guzzle\JoindIn\JoindInClient;

class JoindInClientTest extends \Guzzle\Tests\GuzzleTestCase
{
    public function testBuilderCreatesClient()
    {
        $client = JoindInClient::factory();
    }



    public function testBuildGrantUrl()
    {
        $client = JoindInClient::factory(array(
            'api_key' => 'batman',
            'callback' => '/oauth/callback',
        ));
        $expected = 
            'https://joind.in/user/oauth_allow?api_key=batman&callback=%2Foauth%2Fcallback';
        $this->assertSame($expected, $client->buildGrantUrl());
    }
}