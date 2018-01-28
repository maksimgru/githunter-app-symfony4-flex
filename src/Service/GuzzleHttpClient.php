<?php

namespace App\Service;

use GuzzleHttp\Client;
use RuntimeException;

/**
 * Class GuzzleHttpClient
 * @package App\Service
 *
 */
class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * @var Client $client
     */
    private $client;

    /**
     * Create new GuzzleHttpClient instance.
     *
     */
    public function __construct ()
    {
        $this->client = new Client();
    }

    /**
     * @inheritDoc
     *
     * @return ARRAY
     * @throws RuntimeException
     */
    public function get($url)
    {

        $response = $this->client->get($url);

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @inheritDoc
     */
    public function post($url, $data)
    {
        // not in use, but we must define this method
        // as it is part of the HttpClientInterface interface
    }
}