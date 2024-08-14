<?php

namespace ArdaGnsrn\Ollama;

final class Ollama
{
    private OllamaClient $ollamaClient;

    public static function client(string $host = 'http://localhost:11434'): Ollama
    {
        return new self($host);
    }

    private function __construct(string $host)
    {
        $this->ollamaClient = new OllamaClient($host);
    }

    public function completions(): Resources\Completions
    {
        return new Resources\Completions($this->ollamaClient);
    }

    public function chat(): Resources\Chat
    {
        return new Resources\Chat($this->ollamaClient);
    }
}
