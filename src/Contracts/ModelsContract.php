<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\Models\CreateModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\ListModelsResponse;
use ArdaGnsrn\Ollama\Responses\Models\ListRunningModelsResponse;
use ArdaGnsrn\Ollama\Responses\Models\PullModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\PushModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\ShowModelResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

interface ModelsContract
{
    public function list(): ListModelsResponse;

    public function show(string $modelName, bool $verbose = false): ShowModelResponse;

    public function create(array $parameters): CreateModelResponse;

    public function createStreamed(array $parameters): StreamResponse;

    public function copy(string $source, string $destination): bool;

    public function delete($modelName): bool;

    public function pull(string $modelName, bool $insecure = false): PullModelResponse;

    public function pullStreamed(string $modelName, bool $insecure = false): StreamResponse;

    public function push(string $modelName, bool $insecure = false): PushModelResponse;

    public function pushStreamed(string $modelName, bool $insecure = false): StreamResponse;

    public function runningList(): ListRunningModelsResponse;
}
