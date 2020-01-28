<?php


namespace RbTracker\Requests;


use GuzzleHttp\Client;

abstract class AbstractBasicRequest
{

    protected function buildConfig()
    {
        $client = new Client([
            'base_uri'=>getenv('base_url'),
            'timeout'=>getenv('time_out')
        ]);
    }

    protected function callRequest(){

    }
}