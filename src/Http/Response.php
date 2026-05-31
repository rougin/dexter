<?php

namespace Rougin\Dexter\Http;

use Psr\Http\Message\ResponseInterface;

Interop::register('Response');

/**
 * @package Dexter
 *
 * @property integer                $code
 * @property array<integer, string> $codes
 * @property string                 $reason
 *
 * @method string                              getReasonPhrase()
 * @method integer                             getStatusCode()
 * @method \Psr\Http\Message\ResponseInterface withStatus(integer $code, string $reasonPhrase = '')
 * @method \Psr\Http\Message\StreamInterface   getBody()
 * @method string[]                            getHeader(string $name)
 * @method string                              getHeaderLine(string $name)
 * @method string[][]                          getHeaders()
 * @method string                              getProtocolVersion()
 * @method boolean                             hasHeader(string $name)
 * @method static                              withAddedHeader(string $name, $value)
 * @method static                              withBody(\Psr\Http\Message\StreamInterface $body)
 * @method static                              withHeader(string $name, $value)
 * @method static                              withoutHeader(string $name)
 * @method static                              withProtocolVersion(string $version)
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Response extends PsrResponse implements ResponseInterface
{
    /**
     * Initializes the response instance.
     *
     * @param integer                                $code
     * @param \Psr\Http\Message\StreamInterface|null $body
     * @param array<string, string[]>                $headers
     * @param string                                 $version
     *
     * @todo Remove usage of "null" in this method.
     */
    public function __construct($code = 200, $body = null, array $headers = array(), $version = '1.1')
    {
        parent::__construct($body, $headers, $version);

        $this->code = $code;

        $this->reason = $this->codes[$code];
    }

    /**
     * @param mixed   $data
     * @param integer $code
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function toJson($data, $code = 200)
    {
        $self = new Response($code);

        // Set the type as "application/json" ---
        $type = 'Content-Type';

        $value = 'application/json';

        $self = $self->withHeader($type, $value);
        // --------------------------------------

        // Write the encoded data as JSON ---------
        $encoded = json_encode($data);

        $body = $encoded !== false ? $encoded : '';

        $self->getBody()->write($body);
        // ----------------------------------------

        return $self;
    }
}
