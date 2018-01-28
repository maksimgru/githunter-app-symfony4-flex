<?php

namespace App\Service;

/**
 * interface HttpClientInterface
 * @package App\Service
 *
 */
interface HttpClientInterface
{
    /**
     * This is Description of get
     *
     * @param STRING $url
     *
     */
    public function get($url);

    /**
     * This is Description of post
     *
     * @param STRING $url
     * @param MIXED $data
     *
     */
    public function post($url, $data);
}