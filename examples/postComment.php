<?php

namespace Guzzle\Examples;

require __DIR__.'/../vendor/autoload.php';

use Guzzle\JoindIn\JoindInClient;
use Fishtrap\Guzzle\Plugin\OAuth2Plugin;

$client = new JoindInClient();
$plugin = new Oauth2Plugin(
    array('token' => 'already_gotten_token'),
);
$client->addSubscriber($plugin);
$params = array(
    'talk_id' => 1000,
    'rating' => 3,
    'comment' => 'Medium Rare.',
);
$response = $client->AddTalkComment($params);
var_dump($response);