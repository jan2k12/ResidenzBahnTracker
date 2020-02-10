<?php


namespace RbTracker\Requests;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Message\RequestInterface;

abstract class AbstractBasicRequest
{

    /**
     * @var string
     */
    protected $method = "GET";

    /**
     * @var string
     */
    protected $uri = '/';
    /**
     * @var string
     */
    protected $base_uri;
    /**
     * @var string
     */
    protected $timeout;

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var array
     */
    protected $options = [];

    /**
     * @var Client
     */
    private $client;
    /**
     * @var array
     */
    private $headers = [];

    private $body = null;


    protected function buildConfig()
    {
        $this->base_uri = $_ENV["base_url"];
        $this->timeout = $_ENV["time_out"];
        $this->headers = [
            "Accept" => "application/xml",
            "Authorization" => $_ENV['token']
        ];
        $this->client = new Client();
    }

    /**
     * @return \Psr\Http\Message\StreamInterface
     * @throws \Exception
     */
    public function getRequestResult()
    {
        $request = new Request($this->method, $this->base_uri . $this->uri, $this->headers, $this->body);
        $result = $this->client->send($request, $this->options);
        if ($result->getStatusCode() !== 200) {
            throw(new \Exception($result->getBody()));
        }

        return $result->getBody();
    }
}