<?php

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Resources\Blobs;
use ArdaGnsrn\Ollama\Resources\Chat;
use ArdaGnsrn\Ollama\Resources\Completions;
use ArdaGnsrn\Ollama\Resources\Embed;
use ArdaGnsrn\Ollama\Resources\Models;
use ArdaGnsrn\Ollama\Responses\Models\LoadModelResponse;
use ArdaGnsrn\Ollama\Responses\Models\UnloadModelResponse;

it('may create a client', function () {
    $client = Ollama::client();

    expect($client)->toBeInstanceOf(Ollama::class);
});

it('may create a client with custom host', function () {
    $client = Ollama::client('http://localhost:11435');

    expect($client)->toBeInstanceOf(Ollama::class);
});

it('has blobs', function () {
    $client = Ollama::client();

    expect($client->blobs())->toBeInstanceOf(Blobs::class);
});

it('has chat', function () {
    $client = Ollama::client();

    expect($client->chat())->toBeInstanceOf(Chat::class);
});

it('has completions', function () {
    $client = Ollama::client();

    expect($client->completions())->toBeInstanceOf(Completions::class);
});

it('has embed', function () {
    $client = Ollama::client();

    expect($client->embed())->toBeInstanceOf(Embed::class);
});

it('has models', function () {
    $client = Ollama::client();

    expect($client->models())->toBeInstanceOf(Models::class);
});

it('can tell when ollama is running', function () {
   $client = Ollama::client();

   expect($client->isRunning())->toBeTrue();
});

it('can tell when ollama is not running', function () {
   $client = Ollama::client('http://localhost:9999/not_ollama');

   expect($client->isRunning())->toBeFalse();
});

it('can load a model', function () {
    $client = Ollama::client();

    $result = $client->models()->load('llama3.1');

    expect($result)
        ->toBeInstanceOf(LoadModelResponse::class)
        ->model->toBeString()->toBe('llama3.1')
        ->done->toBeBool()->toBeTrue();
});

it('can unload a model', function () {
    $client = Ollama::client();

    $result = $client->models()->unload('llama3.1');

    expect($result)
        ->toBeInstanceOf(UnloadModelResponse::class)
        ->model->toBeString()->toBe('llama3.1')
        ->done->toBeBool()->toBeTrue();
});

