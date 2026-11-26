<?php

use ArdaGnsrn\Ollama\Responses\Chat\ChatMessageResponse;
use ArdaGnsrn\Ollama\Responses\Chat\ChatMessageToolCallResponse;

test('tool call keeps the id sent by the server', function () {
    $toolCall = ChatMessageToolCallResponse::from([
        'id' => 'call_abc123',
        'function' => ['name' => 'get_weather', 'arguments' => ['city' => 'Paris']],
    ]);

    expect($toolCall)
        ->id->toBe('call_abc123')
        ->function->name->toBe('get_weather');

    expect($toolCall->toArray())->toBe([
        'id' => 'call_abc123',
        'function' => ['name' => 'get_weather', 'arguments' => ['city' => 'Paris']],
    ]);
});

test('tool call id is null and omitted when the server does not send it', function () {
    $toolCall = ChatMessageToolCallResponse::from([
        'function' => ['name' => 'get_weather', 'arguments' => []],
    ]);

    expect($toolCall->id)->toBeNull();
    expect($toolCall->toArray())->not->toHaveKey('id');
});

test('chat message exposes tool call ids', function () {
    $message = ChatMessageResponse::from([
        'role' => 'assistant',
        'content' => '',
        'tool_calls' => [
            ['id' => 'call_1', 'function' => ['name' => 'a', 'arguments' => []]],
            ['id' => 'call_2', 'function' => ['name' => 'b', 'arguments' => []]],
        ],
    ]);

    expect(array_map(fn($call) => $call->id, $message->toolCalls))->toBe(['call_1', 'call_2']);
});
