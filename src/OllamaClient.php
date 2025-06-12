<?php

namespace ArdaGnsrn\Ollama;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Psr\Http\Message\ResponseInterface;

class OllamaClient
{
    /**
     * @var Client
     */
    private Client $guzzleClient;

    /**
     * @param string $host
     * @param string|null $apiKey
     */
    public function __construct(
        private string           $host = 'http://localhost:11434',
        private readonly ?string $apiKey = null,
    )
    {
        $this->host = rtrim($host, '/');
        $this->guzzleClient = new Client($this->clientOptions());
    }

    private function clientOptions(): array
    {
        $opts = ['base_uri' => "{$this->host}/api/"];
        if ($this->apiKey !== null) {
            $opts['headers'] = ['Authorization' => "Bearer {$this->apiKey}"];
        }
        return $opts;
    }

    /**
     * @return bool
     */
    public function isRunning(): bool
    {
        try {
            $client = new Client(['base_uri' => $this->host]);
            $res = $client->get('/');
            $content = $res->getBody()->getContents();

            return $content === 'Ollama is running';
        } catch (GuzzleException $ex) {
            return false;
        }
    }

    /**
     * @param $endpoint
     * @param $parameters
     * @param $parseJson
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
    public function get($endpoint, $parameters = [], $parseJson = true)
    {
        $response = $this->guzzleClient->get($endpoint, [
            'query' => $parameters,
        ]);

        if (!$parseJson) return $response;

        return json_decode($response->getBody(), true);
    }

    /**
     * @param $endpoint
     * @param $parameters
     * @param $stream
     * @param $parseJson
     * @return mixed|ResponseInterface
     * @throws GuzzleException
     */
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

    /**
     * @param $endpoint
     * @param $parameters
     * @return ResponseInterface
     * @throws GuzzleException
     */
    public function delete($endpoint, $parameters = []): ResponseInterface
    {
        return $this->guzzleClient->delete($endpoint, [
            'json' => $parameters,
        ]);
    }
}
