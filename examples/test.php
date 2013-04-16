<?php

namespace Guzzle\Examples;

require __DIR__.'/../vendor/autoload.php';

use Guzzle\JoindIn\JoindInClient;

$client = new JoindInClient();
$filters = $client->EventFilters();
$hotEvents = $client->EventsList(array('filter' => 'hot'));
$hottestEvent = $hotEvents['events'][0];
var_dump($hottestEvent['name']);
