<?php

/*
 * This file is part of the hedeqiang/easyjiguang.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace EasyJiGuang\Kernel\Http;

use EasyJiGuang\Kernel\Support\Collection;
use EasyJiGuang\Kernel\Support\XML;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response.
 */
class Response extends GuzzleResponse
{
    public function getBodyContents(): string
    {
        $this->getBody()->rewind();
        $contents = $this->getBody()->getContents();
        $this->getBody()->rewind();

        return $contents;
    }

    /**
     * @param ResponseInterface $response
     *
     * @return \EasyJiGuang\Kernel\Http\Response
     */
    public static function buildFromPsrResponse(ResponseInterface $response): Response
    {
        return new static(
            $response->getStatusCode(),
            $response->getHeaders(),
            $response->getBody(),
            $response->getProtocolVersion(),
            $response->getReasonPhrase()
        );
    }

    /**
     * Build to json.
     *
     * @return string
     */
    public function toJson(): string
    {
        return json_encode($this->toArray());
    }

    /**
     * Build to array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $content = $this->removeControlCharacters($this->getBodyContents());

        if (false !== stripos($this->getHeaderLine('Content-Type'), 'xml') || 0 === stripos($content, '<xml')) {
            return XML::parse($content);
        }

        $array = json_decode($content, true, 512, JSON_BIGINT_AS_STRING);

        if (JSON_ERROR_NONE === json_last_error()) {
            return (array) $array;
        }

        return [];
    }

    /**
     * Get collection data.
     *
     * @return \EasyJiGuang\Kernel\Support\Collection
     */
    public function toCollection(): Collection
    {
        return new Collection($this->toArray());
    }

    /**
     * @return object
     */
    public function toObject()
    {
        return json_decode($this->toJson());
    }

    /**
     * @return bool|string
     */
    public function __toString()
    {
        return $this->getBodyContents();
    }

    /**
     * @param string $content
     *
     * @return string
     */
    protected function removeControlCharacters(string $content): string
    {
        return preg_replace('/[\x00-\x1F\x80-\x9F]/u', '', $content);
    }
}
