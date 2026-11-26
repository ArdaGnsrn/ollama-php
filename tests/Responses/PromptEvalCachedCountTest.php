<?php

use ArdaGnsrn\Ollama\Responses\Chat\ChatResponse;
use ArdaGnsrn\Ollama\Responses\Completions\CompletionResponse;

test('chat response keeps prompt_eval_cached_count', function () {
    $attributes = [
        'model' => 'llama3.1',
        'created_at' => '2025-01-01T00:00:00Z',
        'message' => ['role' => 'assistant', 'content' => 'Hi'],
        'done' => true,
        'prompt_eval_count' => 120,
    ];

    $with = ChatResponse::from($attributes + ['prompt_eval_cached_count' => 100]);
    expect($with->promptEvalCachedCount)->toBe(100);
    expect($with->toArray())->toHaveKey('prompt_eval_cached_count', 100);

    $without = ChatResponse::from($attributes);
    expect($without->promptEvalCachedCount)->toBeNull();
    expect($without->toArray())->not->toHaveKey('prompt_eval_cached_count');
});

test('completion response keeps prompt_eval_cached_count', function () {
    $attributes = [
        'model' => 'llama3.1',
        'created_at' => '2025-01-01T00:00:00Z',
        'response' => 'Hi',
        'done' => true,
        'prompt_eval_count' => 120,
    ];

    $with = CompletionResponse::from($attributes + ['prompt_eval_cached_count' => 100]);
    expect($with->promptEvalCachedCount)->toBe(100);
    expect($with->toArray())->toHaveKey('prompt_eval_cached_count', 100);

    $without = CompletionResponse::from($attributes);
    expect($without->promptEvalCachedCount)->toBeNull();
    expect($without->toArray())->not->toHaveKey('prompt_eval_cached_count');
});
