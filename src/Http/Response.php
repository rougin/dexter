<?php

namespace Rougin\Dexter\Http;

use Rougin\Slytherin\Http\Response as Slytherin;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Response extends Slytherin
{
    /**
     * @param mixed   $data
     * @param integer $code
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public static function toJson($data, $code = 200)
    {
        $self = new Slytherin($code);

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
