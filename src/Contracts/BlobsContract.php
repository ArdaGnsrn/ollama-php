<?php

namespace ArdaGnsrn\Ollama\Contracts;

interface BlobsContract
{
    public function exists(string $digest): bool;

    public function create(string $digest): bool;
}
