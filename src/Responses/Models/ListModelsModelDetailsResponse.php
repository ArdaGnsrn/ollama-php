<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class ListModelsModelDetailsResponse implements ResponseContract
{
    private function __construct(
        public readonly string $format,
        public readonly string $family,
        public readonly string $parameterSize,
        public readonly string $quantizationLevel,
        public readonly array $families = [],
    )
    {
    }

    public static function from(array $attributes): ListModelsModelDetailsResponse
    {
        return new self(
            format: $attributes['format'],
            family: $attributes['family'],
            parameterSize: $attributes['parameter_size'],
            quantizationLevel: $attributes['quantization_level'],
            families: $attributes['families'],
        );
    }

    public function toArray(): array
    {
        return [
            'format' => $this->format,
            'family' => $this->family,
            'parameter_size' => $this->parameterSize,
            'quantization_level' => $this->quantizationLevel,
            'families' => $this->families,
        ];
    }
}
