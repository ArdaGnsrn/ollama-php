<?php

namespace ArdaGnsrn\Ollama\Responses\Chat;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ChatMessageToolCallFunctionResponse implements ResponseContract
{
    private function __construct(
        public readonly string $name,
        public readonly array  $arguments,
    )
    {
    }

    public static function from(array $attributes): ChatMessageToolCallFunctionResponse
    {
        return new self(
            name: $attributes['name'],
            arguments: $attributes['arguments'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'arguments' => $this->arguments,
        ];
    }
}
