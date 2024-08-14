<?php

namespace ArdaGnsrn\Ollama\Responses;

use ArdaGnsrn\Ollama\Contracts\StreamResponseContract;
use Generator;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class StreamResponse implements StreamResponseContract
{
    public function __construct(
        private readonly string            $responseClass,
        private readonly ResponseInterface $response,
    )
    {
        //
    }

    public function getIterator(): Generator
    {
        while (!$this->response->getBody()->eof()) {
            $line = $this->readLine($this->response->getBody());

            if (empty($line)) continue;

            $response = json_decode($line, true, flags: JSON_THROW_ON_ERROR);

            if (isset($response['error'])) {
                throw new \Exception($response['error']);
            }

            yield $this->responseClass::from($response);
        }
    }

    /**
     * Read a line from the stream.
     */
    private function readLine(StreamInterface $stream): string
    {
        $buffer = '';

        while (!$stream->eof()) {
            if ('' === ($byte = $stream->read(1))) {
                return $buffer;
            }
            $buffer .= $byte;
            if ($byte === "\n") {
                break;
            }
        }

        return $buffer;
    }
}
