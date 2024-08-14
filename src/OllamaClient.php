<?php

namespace ArdaGnsrn\Ollama;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class OllamaClient
{
    private Client $guzzleClient;

    public function __construct(string $host = 'http://localhost:11434')
    {
        $this->guzzleClient = new Client([
            'base_uri' => "$host/api/",
        ]);
    }

    public function get($endpoint, $parameters = [], $parseJson = true)
    {
        $response = $this->guzzleClient->get($endpoint, [
            'query' => $parameters,
        ]);

        if (!$parseJson) return $response;

        return json_decode($response->getBody(), true);
    }

    public function post($endpoint, $parameters = [], $stream = false, $parseJson = true)
    {
        $response = $this->guzzleClient->post($endpoint, [
            'json' => [
                ...$parameters,
                'stream' => $stream,
            ],
            'stream' => $stream,
        ]);

        if ($stream || !$parseJson) return $response;

        return json_decode($response->getBody(), true);
    }

    public function delete($endpoint, $parameters = []): ResponseInterface
    {
        return $this->guzzleClient->delete($endpoint, [
            'json' => $parameters,
        ]);
    }
}
