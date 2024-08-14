<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;
use ArdaGnsrn\Ollama\Responses\Tags\TagsModelDetailsResponse;

class ListModelsModelResponse implements ResponseContract
{
    private function __construct(
        public readonly string $name,
        public readonly string $modifiedAt,
        public readonly int $size,
        public readonly string $digest,
        public readonly ListModelsModelDetailsResponse $details,
    )
    {
    }

    public static function from(array $attributes): ListModelsModelResponse
    {
        return new self(
            name: $attributes['name'],
            modifiedAt: $attributes['modified_at'],
            size: $attributes['size'],
            digest: $attributes['digest'],
            details: ListModelsModelDetailsResponse::from($attributes['details']),
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'modified_at' => $this->modifiedAt,
            'size' => $this->size,
            'digest' => $this->digest,
            'details' => $this->details->toArray(),
        ];
    }
}
