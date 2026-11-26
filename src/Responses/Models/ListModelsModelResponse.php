<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ListModelsModelResponse implements ResponseContract
{
    /**
     * @param string $name
     * @param string $modifiedAt
     * @param int $size
     * @param string $digest
     * @param ListModelsModelDetailsResponse $details
     * @param string[]|null $capabilities
     */
    private function __construct(
        public readonly string                         $name,
        public readonly string                         $modifiedAt,
        public readonly int                            $size,
        public readonly string                         $digest,
        public readonly ListModelsModelDetailsResponse $details,
        public readonly ?array                         $capabilities = null,
    )
    {
    }

    /**
     * @param array $attributes
     * @return ListModelsModelResponse
     */
    public static function from(array $attributes): ListModelsModelResponse
    {
        return new self(
            name: $attributes['name'],
            modifiedAt: $attributes['modified_at'],
            size: $attributes['size'],
            digest: $attributes['digest'],
            details: ListModelsModelDetailsResponse::from($attributes['details']),
            capabilities: $attributes['capabilities'] ?? null,
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return array_filter([
            'name' => $this->name,
            'modified_at' => $this->modifiedAt,
            'size' => $this->size,
            'digest' => $this->digest,
            'details' => $this->details->toArray(),
            'capabilities' => $this->capabilities,
        ], static fn($value): bool => $value !== null);
    }
}
