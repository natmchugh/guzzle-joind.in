<?php

namespace Guzzle\Examples;

require __DIR__.'/../vendor/autoload.php';

use Guzzle\JoindIn\JoindInClient;

$client = new JoindInClient();
$params = array(
    'format' => 'json',
    'resultsperpage' => 10,
    'start' => 0,
    'verbose' => 'yes',
    'talk_id' => 1000,
);

$response = $client->TalkComments($params);
var_dump($response);
