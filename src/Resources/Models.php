<?php

namespace ArdaGnsrn\Ollama\Resources;

use ArdaGnsrn\Ollama\Contracts\ModelsContract;
use ArdaGnsrn\Ollama\OllamaClient;
use ArdaGnsrn\Ollama\Responses\Models\CreateModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\ListModelsResponse;
use ArdaGnsrn\Ollama\Responses\Models\PullModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\PushModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\ShowModelResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

final class Models implements ModelsContract
{
    private OllamaClient $ollamaClient;

    public function __construct(OllamaClient $ollamaClient)
    {
        $this->ollamaClient = $ollamaClient;
    }

    public function list(): ListModelsResponse
    {
        $response = $this->ollamaClient->get('tags');
        return ListModelsResponse::from($response);
    }

    public function show(string $modelName, bool $verbose = false): ShowModelResponse
    {
        $response = $this->ollamaClient->post('show', [
            'name' => $modelName,
            'verbose' => $verbose,
        ]);
        return ShowModelResponse::from($response);
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

    public function copy(string $source, string $destination): bool
    {
        try {
            $response = $this->ollamaClient->post('copy', [
                'source' => $source,
                'destination' => $destination,
            ], parseJson: false);

            return in_array($response->getStatusCode(), [200, 201]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function delete($modelName): bool
    {
        try {
            $response = $this->ollamaClient->delete("delete", [
                'name' => $modelName,
            ]);
            return in_array($response->getStatusCode(), [200, 204]);
        } catch (\Exception $e) {
            return false;
        }
    }

    public function pull(string $modelName, bool $insecure = false): PullModelResponse
    {
        $response = $this->ollamaClient->post('pull', [
            'name' => $modelName,
            'insecure' => $insecure,
        ]);
        return PullModelResponse::from($response);
    }

    public function pullStreamed(string $modelName, bool $insecure = false): StreamResponse
    {
        $response = $this->ollamaClient->post('pull', [
            'name' => $modelName,
            'insecure' => $insecure,
        ], true);
        return new StreamResponse(PullModelResponse::class, $response);
    }

    public function push(string $modelName, bool $insecure = false): PushModelResponse
    {
        $response = $this->ollamaClient->post('push', [
            'name' => $modelName,
            'insecure' => $insecure,
        ]);
        return PushModelResponse::from($response);
    }

    public function pushStreamed(string $modelName, bool $insecure = false): StreamResponse
    {
        $response = $this->ollamaClient->post('push', [
            'name' => $modelName,
            'insecure' => $insecure,
        ], true);
        return new StreamResponse(PushModelResponse::class, $response);
    }
}
