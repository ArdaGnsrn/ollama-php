<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\ChatContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\Chat\ChatResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

final class Chat implements ChatContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function create(array $parameters): ChatResponse
    {
        $response = $this->ollamaClient->post('chat', $parameters, false);
        return ChatResponse::from($response);
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        if (isset($parameters['tools'])) {
            throw new \InvalidArgumentException('You cannot use tools in streamed chat messages.');
        }

        $response = $this->ollamaClient->post('chat', $parameters, true);
        return new StreamResponse(ChatResponse::class, $response);
    }
}
