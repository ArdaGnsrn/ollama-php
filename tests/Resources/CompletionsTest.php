<?php

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Responses\Completions\CompletionResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

test('create completions', function () {
    $client = Ollama::client();

    $result = $client->completions()->create([
        'model' => 'llama3.1',
        'prompt' => 'Hello, my name is',
        'max_tokens' => 10,
    ]);

    expect($result)
        ->toBeInstanceOf(CompletionResponse::class)
        ->done->toBeBool()->toBeTrue()
        ->model->toBeString()->toBe('llama3.1')
        ->response->toBeString()
        ->totalDuration->toBeInt()
        ->loadDuration->toBeInt()
        ->promptEvalCount->toBeInt();
});

test('create completions as a stream', function () {
    $client = Ollama::client();

    $result = $client->completions()->createStreamed([
        'model' => 'llama3.1',
        'prompt' => 'Hello, my name is',
        'max_tokens' => 10,
    ]);

    expect($result)->toBeInstanceOf(StreamResponse::class);

    foreach ($result as $response) {
        expect($response)
            ->toBeInstanceOf(CompletionResponse::class)
            ->model->toBeString()->toBe('llama3.1')
            ->response->toBeString();
    }
});
