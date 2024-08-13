<?php

it('can test', function () {
    $client = \ArdaGnsrn\Ollama\Ollama::client();

    $response = $client->completions()->create([
        'model' => 'llama3.1',
        'prompt' => 'Once upon a time',
    ]);

    print_r("--------------------\n");
    print_r($response);
    print_r("--------------------\n");

    expect($response)->toBeArray();
});
