<?php

namespace Guzzle\JoindIn;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\Http\Message\RequestInterface;

class JoindInClient extends Client
{
    public function __construct($baseUrl = '', $config = null)
    {
        $default = array();
        $required = array('apikey');
        $config = Collection::fromConfig($config, $default, $required);

        parent::__construct($baseUrl, $config);
        $this->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.json'));
    }

    public function createRequest($method = RequestInterface::GET, $uri = null, $headers = null, $body = null)
    {
        $request = parent::createRequest($method, $uri, $headers, $body);

        $request->getQuery()->set('apikey', $this->getConfig()->get('apikey'));

        return $request;
    }


}