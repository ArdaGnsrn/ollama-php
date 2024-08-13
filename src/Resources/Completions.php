<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\CompletionsContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\CompletionResponse;

final class Completions implements CompletionsContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function create(array $parameters, $stream = false): CompletionResponse
    {
        $response = $this->ollamaClient->post('generate', $parameters, $stream);
        return CompletionResponse::from($response);
    }
}
