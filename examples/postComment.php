<?php

namespace Guzzle\Examples;

require __DIR__.'/../vendor/autoload.php';

use Guzzle\JoindIn\JoindInClient;
use Fishtrap\Guzzle\Plugin\OAuth2Plugin;

$client = JoindInClient::factory(
    array('access_token' => 'nanana')
);
$params = array(
    'talk_id' => 1000,
    'rating' => 3,
    'comment' => 'Medium Rare.',
);
$response = $client->AddTalkComment($params);
var_dump($response);