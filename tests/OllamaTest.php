<?php

use ArdaGnsrn\Ollama\Ollama;
use ArdaGnsrn\Ollama\Resources\Blobs;
use ArdaGnsrn\Ollama\Resources\Chat;
use ArdaGnsrn\Ollama\Resources\Completions;
use ArdaGnsrn\Ollama\Resources\Embed;
use ArdaGnsrn\Ollama\Resources\Models;

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


