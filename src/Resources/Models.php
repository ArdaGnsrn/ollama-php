<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\ModelsContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\Models\CreateModelResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

final class Models implements ModelsContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function create(array $parameters): CreateModelResponse
    {
        $response = $this->ollamaClient->post('create', $parameters, false);
        return CreateModelResponse::from($response);
    }

    public function createStreamed(array $parameters): StreamResponse
    {
        $response = $this->ollamaClient->post('create', $parameters, true);
        return new StreamResponse(CreateModelResponse::class, $response);
    }
}
