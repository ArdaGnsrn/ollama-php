<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\Chat\ChatResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

interface ChatContract
{

    public function create(array $parameters): ChatResponse;

    public function createStreamed(array $parameters): StreamResponse;
}
