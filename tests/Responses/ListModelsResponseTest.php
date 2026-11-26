<?php

use ArdaGnsrn\Ollama\Responses\Models\ListModelsModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\ListRunningModelsModelResponse;

function modelDetails(): array
{
    return [
        'parent_model' => '',
        'format' => 'gguf',
        'family' => 'llama',
        'families' => ['llama'],
        'parameter_size' => '8B',
        'quantization_level' => 'Q4_K_M',
    ];
}

test('listed model keeps its capabilities', function () {
    $model = ListModelsModelResponse::from([
        'name' => 'llama3.1:8b',
        'modified_at' => '2025-01-01T00:00:00Z',
        'size' => 4920753328,
        'digest' => 'abc123',
        'details' => modelDetails(),
        'capabilities' => ['completion', 'tools'],
    ]);

    expect($model->capabilities)->toBe(['completion', 'tools']);
    expect($model->toArray())->toHaveKey('capabilities', ['completion', 'tools']);
});

test('listed model capabilities are null and omitted when not reported', function () {
    $model = ListModelsModelResponse::from([
        'name' => 'llama3.1:8b',
        'modified_at' => '2025-01-01T00:00:00Z',
        'size' => 4920753328,
        'digest' => 'abc123',
        'details' => modelDetails(),
    ]);

    expect($model->capabilities)->toBeNull();
    expect($model->toArray())->not->toHaveKey('capabilities');
});

test('running model keeps its context length', function () {
    $attributes = [
        'name' => 'llama3.1:8b',
        'model' => 'llama3.1:8b',
        'size' => 5137025024,
        'digest' => 'abc123',
        'details' => modelDetails(),
        'expires_at' => '2025-01-01T00:05:00Z',
        'size_vram' => 5137025024,
    ];

    $with = ListRunningModelsModelResponse::from($attributes + ['context_length' => 8192]);
    expect($with->contextLength)->toBe(8192);
    expect($with->toArray())->toHaveKey('context_length', 8192);

    $without = ListRunningModelsModelResponse::from($attributes);
    expect($without->contextLength)->toBeNull();
    expect($without->toArray())->not->toHaveKey('context_length');
});
