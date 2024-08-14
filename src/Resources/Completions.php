<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\CompletionsContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\Completions\CompletionResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

final class Completions implements CompletionsContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function create(array $parameters): CompletionResponse
    {
        $response = $this->ollamaClient->post('generate', $parameters, false);
        return CompletionResponse::from($response);
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        $response = $this->ollamaClient->post('generate', $parameters, true);
        return new StreamResponse(CompletionResponse::class, $response);
    }
}
