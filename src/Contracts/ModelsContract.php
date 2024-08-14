<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\Models\CreateModelResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

interface ModelsContract
{
    public function create(array $parameters): CreateModelResponse;

    public function createStreamed(array $parameters): StreamResponse;
}
