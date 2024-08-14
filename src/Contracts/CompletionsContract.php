<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\CompletionResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

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
    public function create(array $parameters): CompletionResponse;

    /**
     * Create a new completion and stream the response.
     *
     * @param array $parameters
     *
     * @return StreamResponse
     */
    public function createStreamed(array $parameters): StreamResponse;
}
