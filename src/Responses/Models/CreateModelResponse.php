<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class CreateModelResponse implements ResponseContract
{
    private function __construct(
        public readonly string $status,
    )
    {
    }

    public static function from(array $attributes): CreateModelResponse
    {
        return new self(
            status: $attributes['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'status' => $this->status,
        ];
    }
}
