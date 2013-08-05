<?php

namespace Guzzle\JoindIn;

use Guzzle\Common\Collection;
use Guzzle\Service\Client;
use Guzzle\Service\Description\ServiceDescription;
use Guzzle\JoindIn\Exception\AuthErrorException;
use Guzzle\Http\Message\RequestInterface;
use Fishtrap\Guzzle\Plugin\OAuth2Plugin;

class JoindInClient extends Client
{
    public function __construct($baseUrl = '', $config = null)
    {
        $default = array();
        $required = array();
        $config = Collection::fromConfig($config, $default, $required);

        parent::__construct($baseUrl, $config);
        $this->setDescription(ServiceDescription::factory(__DIR__ . DIRECTORY_SEPARATOR . 'client.json'));
    }

    public function createRequest($method = RequestInterface::GET, $uri = null, $headers = null, $body = null, array $options = Array())
    {
        $methodsRequiringAuth = array(RequestInterface::POST, RequestInterface::PUT, RequestInterface::DELETE);
        $accessToken = $this->getConfig('access_token');
        if (in_array($method, $methodsRequiringAuth)) {
            if (empty($accessToken)) {
                throw new AuthErrorException('Need to be logged in to use method '.$method);
            }
            $oauth = new Oauth2Plugin(array(
                'access_token'    => $this->getConfig('access_token'),
                'token_format' => 'OAuth',
            ));
            $this->addSubscriber($oauth);
        }
        return parent::createRequest($method, $uri, $headers, $body);
    }

    public function buildGrantUrl()
    {
        $queryData = $this->getConfig()->getAll(array('api_key', 'callback'));
        $queryString = http_build_query($queryData);
        return sprintf('https://joind.in/user/oauth_allow?%s', $queryString);
    }
}
