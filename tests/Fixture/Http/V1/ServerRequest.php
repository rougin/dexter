<?php

namespace Rougin\Dexter\Fixture\Http\V1;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Rougin\Dexter\Http\V1\Message;

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
    public function getQueryParams()
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
    public function withParsedBody($data)
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
    public function withQueryParams(array $query)
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
    public function getMethod()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    public function getRequestTarget()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return \Psr\Http\Message\UriInterface
     */
    public function getUri()
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
    public function withMethod($method)
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
    public function withRequestTarget($requestTarget)
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
    public function withUri(UriInterface $uri, $preserveHost = false)
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
    public function getAttribute($name, $default = null)
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getAttributes()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getCookieParams()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, string>
     */
    public function getServerParams()
    {
        throw new \BadMethodCallException('Not implemented');
    }

    /**
     * @codeCoverageIgnore
     *
     * @return array<string, \Psr\Http\Message\UploadedFileInterface[]>
     */
    public function getUploadedFiles()
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
    public function withAttribute($name, $value)
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
    public function withCookieParams(array $cookies)
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
    public function withUploadedFiles(array $uploadedFiles)
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
    public function withoutAttribute($name)
    {
        throw new \BadMethodCallException('Not implemented');
    }
}
