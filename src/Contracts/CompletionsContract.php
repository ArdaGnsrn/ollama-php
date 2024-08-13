<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\CompletionResponse;

interface CompletionsContract
{
    /**
     * Create a new completion.
     *
     * @param array $parameters
     * @param bool $stream
     *
     * @return CompletionResponse
     */
    public function create(array $parameters, bool $stream = false): CompletionResponse;
}
