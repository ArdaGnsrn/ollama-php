<?php

namespace ArdaGnsrn\Ollama\Responses\Chat;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ChatMessageResponse implements ResponseContract
{
    private function __construct(
        public readonly string $role,
        public readonly string $content,
        public readonly array $toolCalls = [],
    )
    {
    }

    public static function from(array $attributes): ChatMessageResponse
    {
        return new self(
            role: $attributes['role'],
            content: $attributes['content'],
            toolCalls: array_map(
                fn(array $toolCall) => ChatMessageToolCallResponse::from($toolCall),
                $attributes['tool_calls'] ?? [],
            ),
        );
    }

    public function toArray(): array
    {
        return [
            'role' => $this->role,
            'content' => $this->content,
            'tool_calls' => array_map(
                static fn(ChatMessageToolCallResponse $response): array => $response->toArray(),
                $this->toolCalls,
            ),
        ];
    }
}
