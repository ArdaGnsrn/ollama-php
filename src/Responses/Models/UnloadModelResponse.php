<?php

namespace ArdaGnsrn\Ollama\Responses\Models;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class UnloadModelResponse implements ResponseContract
{
    /**
     * @param string $model
     * @param string $created_at
     * @param string $response
     * @param bool $done
     * @param string $done_reason
     */
    private function __construct(
        public readonly string                         $model,
        public readonly string                         $created_at,
        public readonly string                         $response,
        public readonly bool                           $done,
        public readonly string                         $done_reason,

    )
    {
    }

    /**
     * @param array $attributes
     * @return UnloadModelResponse
     */
    public static function from(array $attributes): UnloadModelResponse
    {
        return new self(
            model: $attributes['model'],
            created_at: $attributes['created_at'],
            response: $attributes['response'],
            done: $attributes['done'],
            done_reason: $attributes['done_reason'],
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
            'done_reason' => $this->done_reason,
        ];
    }
}
