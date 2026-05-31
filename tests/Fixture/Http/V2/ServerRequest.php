<?php

namespace Rougin\Dexter\Fixture\Http\V2;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Rougin\Dexter\Http\V2\Message;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ServerRequest extends Message implements ServerRequestInterface
{
    /**
     * @var array<string, string>
     */
    protected $server = array();

    /**
     * @var array<string, mixed>|object|null
     */
    protected $data = array();

    /**
     * @var array<string, string>
     */
    protected $query = array();

    /**
     * Initializes the server request instance.
     *
     * @param array<string, string> $server
     */
    public function __construct(array $server)
    {
        $this->server = $server;

        $this->data = array();

        $this->query = array();
    }

    /**
     * Retrieve any parameters provided in the
     * request body.
     *
     * @return array<string, mixed>|object|null
     */
    public function getParsedBody()
    {
        return $this->data;
    }

    /**
     * Retrieve query string arguments.
     *
     * @return array<string, string>
     */
    public function getQueryParams(): array
    {
        return $this->query;
    }

    /**
     * Returns an instance with the specified
     * body parameters.
     *
     * @param array<string, mixed>|object|null $data
     *
     * @return static
     */
    public function withParsedBody($data): ServerRequestInterface
    {
        $static = clone $this;

        $static->data = $data;

        return $static;
    }

    /**
     * Returns an instance with the specified
     * query string arguments.
     *
     * @param array<string, string> $query
     *
     * @return static
     */
    public function withQueryParams(array $query): ServerRequestInterface
    {
        $static = clone $this;

        $static->query = $query;

        return $static;
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getMethod(): string
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getRequestTarget(): string
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri(): \Psr\Http\Message\UriInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $method
     *
     * @return static
     */
    public function withMethod(string $method): \Psr\Http\Message\RequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $requestTarget
     *
     * @return static
     */
    public function withRequestTarget(string $requestTarget): \Psr\Http\Message\RequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param \Psr\Http\Message\UriInterface $uri
     * @param boolean                        $preserveHost
     *
     * @return static
     */
    public function withUri(UriInterface $uri, bool $preserveHost = false): \Psr\Http\Message\RequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getAttribute(string $name, $default = null)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getAttributes(): array
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getCookieParams(): array
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getServerParams(): array
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, \Psr\Http\Message\UploadedFileInterface[]>
     */
    public function getUploadedFiles(): array
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $name
     * @param string $value
     *
     * @return static
     */
    public function withAttribute(string $name, $value): ServerRequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array<string, string> $cookies
     *
     * @return static
     */
    public function withCookieParams(array $cookies): ServerRequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param array<string, \Psr\Http\Message\UploadedFileInterface[]> $uploadedFiles
     *
     * @return static
     */
    public function withUploadedFiles(array $uploadedFiles): ServerRequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @param string $name
     *
     * @return static
     */
    public function withoutAttribute(string $name): ServerRequestInterface
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
