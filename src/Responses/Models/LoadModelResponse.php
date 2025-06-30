<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class LoadModelResponse implements ResponseContract
{
    /**
     * @param string $model
     * @param string $created_at
     * @param string $response
     * @param bool $done
     */
    private function __construct(
        public readonly string                         $model,
        public readonly string                         $created_at,
        public readonly string                         $response,
        public readonly bool                           $done,
    )
    {
    }

    /**
     * @param array $attributes
     * @return LoadModelResponse
     */
    public static function from(array $attributes): LoadModelResponse
    {
        return new self(
            model: $attributes['model'],
            created_at: $attributes['created_at'],
            response: $attributes['response'],
            done: $attributes['done'],
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'created_at' => $this->created_at,
            'response' => $this->response,
            'done' => $this->done,
        ];
    }
}
