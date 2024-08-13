<?php

namespace ArdaGnsrn\Ollama;

use GuzzleHttp\Client;

class OllamaClient
{
    private Client $guzzleClient;

    public function __construct(string $host = 'http://localhost:11434')
    {
        $this->guzzleClient = new Client([
            'base_uri' => "$host/api/",
        ]);
    }

    public function post($endpoint, $parameters, $stream)
    {
        $response = $this->guzzleClient->post($endpoint, [
            'json' => [
                ...$parameters,
                'stream' => $stream,
            ],
            'stream' => $stream,
        ]);

        if ($stream) return $response;

        return json_decode($response->getBody(), true);
    }
}
