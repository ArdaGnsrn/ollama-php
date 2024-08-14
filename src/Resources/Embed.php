<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\EmbedContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\Embed\EmbedResponse;

final class Embed implements EmbedContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function create(array $parameters): EmbedResponse
    {
        $response = $this->ollamaClient->post('embed', $parameters, false);
        return EmbedResponse::from($response);
    }
}
