<?php

namespace ArdaGnsrn\Ollama\Responses\Chat;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ChatMessageToolCallResponse implements ResponseContract
{
    /**
     * @param ChatMessageToolCallFunctionResponse $function
     * @param string|null $id
     */
    private function __construct(
        public readonly ChatMessageToolCallFunctionResponse $function,
        public readonly ?string $id = null,
    )
    {
    }

    /**
     * @param array $attributes
     * @return ChatMessageToolCallResponse
     */
    public static function from(array $attributes): ChatMessageToolCallResponse
    {
        return new self(
            function: ChatMessageToolCallFunctionResponse::from($attributes['function']),
            id: $attributes['id'] ?? null,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'function' => $this->function->toArray(),
        ], static fn($value): bool => $value !== null);
    }
}
