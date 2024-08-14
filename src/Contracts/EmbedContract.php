<?php

namespace ArdaGnsrn\Ollama\Contracts;

use ArdaGnsrn\Ollama\Responses\Chat\ChatResponse;
use ArdaGnsrn\Ollama\Responses\Embed\EmbedResponse;

interface EmbedContract
{
    public function create(array $parameters): EmbedResponse;
}
