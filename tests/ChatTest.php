<?php

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Responses\Chat\ChatMessageResponse;
use ArdaGnsrn\Ollama\Responses\Chat\ChatResponse;
use ArdaGnsrn\Ollama\Responses\StreamResponse;

test('create chat', function () {
    $client = Ollama::client();

    $result = $client->chat()->create([
        'model' => 'llama3.1',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);

    expect($result)
        ->toBeInstanceOf(ChatResponse::class)
        ->done->toBeBool()->toBeTrue()
        ->model->toBeString()->toBe('llama3.1')
        ->message->toBeInstanceOf(ChatMessageResponse::class)
        ->message->role->toBe('assistant')
        ->message->content->toBeString()
        ->message->toolCalls->toBeArray()->toBeEmpty()
        ->totalDuration->toBeInt()
        ->loadDuration->toBeInt()
        ->promptEvalCount->toBeInt();
});

test('create chat as a stream', function () {
    $client = Ollama::client();

    $result = $client->chat()->createStreamed([
        'model' => 'llama3.1',
        'messages' => [
            ['role' => 'user', 'content' => 'Hello!'],
        ],
    ]);

    expect($result)->toBeInstanceOf(StreamResponse::class);

    foreach ($result as $response) {
        expect($response)
            ->toBeInstanceOf(ChatResponse::class)
            ->model->toBeString()->toBe('llama3.1')
            ->message->toBeInstanceOf(ChatMessageResponse::class)
            ->message->role->toBe('assistant')
            ->message->content->toBeString()
            ->message->toolCalls->toBeArray()->toBeEmpty();
    }
});
