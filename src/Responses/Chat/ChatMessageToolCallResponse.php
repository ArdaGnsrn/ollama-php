<?php

namespace ArdaGnsrn\Ollama\Responses\Chat;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ChatMessageToolCallResponse implements ResponseContract
{
    private function __construct(
        public readonly ChatMessageToolCallFunctionResponse $function,
    )
    {
    }

    public static function from(array $attributes): ChatMessageToolCallResponse
    {
        return new self(
            function: ChatMessageToolCallFunctionResponse::from($attributes['function']),
        );
    }

    public function toArray(): array
    {
        return [
            'function' => $this->function->toArray(),
        ];
    }
}
