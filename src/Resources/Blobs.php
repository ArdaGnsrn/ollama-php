<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\BlobsContract;
use ArdaGnsrn\Ollama\OllamaClient;

final class Blobs implements BlobsContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }


    public function exists(string $digest): bool
    {
        try {
            $response = $this->ollamaClient->get("blobs/$digest");
            return $response->getStatusCode() === 200;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function create(string $digest): bool
    {
        $response = $this->ollamaClient->post("blobs/$digest", parseJson: false);
        return in_array($response->getStatusCode(), [200, 201]);
    }
}
