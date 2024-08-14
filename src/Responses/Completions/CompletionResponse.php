<?php

namespace ArdaGnsrn\Ollama\Responses\Completions;

use ArdaGnsrn\Ollama\Contracts\ResponseContract;

class CompletionResponse implements ResponseContract
{
    private function __construct(
        public readonly string $model,
        public readonly string $createdAt,
        public readonly string $response,
        public readonly bool   $done,
        public readonly ?string $doneReason,
        public readonly ?int    $totalDuration,
        public readonly ?int    $loadDuration,
        public readonly ?int    $promptEvalCount,
        public readonly ?int    $promptEvalDuration,
        public readonly ?int    $evalCount,
        public readonly ?int    $evalDuration,
    )
    {
    }

    public static function from(array $attributes): CompletionResponse
    {
        return new self(
            model: $attributes['model'],
            createdAt: $attributes['created_at'],
            response: $attributes['response'],
            done: $attributes['done'],
            doneReason: $attributes['done_reason'],
            totalDuration: $attributes['total_duration'] ?? null,
            loadDuration: $attributes['load_duration'] ?? null,
            promptEvalCount: $attributes['prompt_eval_count'] ?? null,
            promptEvalDuration: $attributes['prompt_eval_duration'] ?? null,
            evalCount: $attributes['eval_count'] ?? null,
            evalDuration: $attributes['eval_duration'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'model' => $this->model,
            'created_at' => $this->createdAt,
            'response' => $this->response,
            'done' => $this->done,
            'done_reason' => $this->doneReason,
            'total_duration' => $this->totalDuration,
            'load_duration' => $this->loadDuration,
            'prompt_eval_count' => $this->promptEvalCount,
            'prompt_eval_duration' => $this->promptEvalDuration,
            'eval_count' => $this->evalCount,
            'eval_duration' => $this->evalDuration,
        ];
    }
}
