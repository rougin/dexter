<?php

namespace Rougin\Dexter\Fixture\Http;

use Psr\Http\Message\ServerRequestInterface;
use Rougin\Dexter\Http\Interop;

$num = Interop::isVersion2() ? '\V2' : '\V1';
$orig = 'Rougin\Dexter\Fixture\Http' . $num . '\ServerRequest';
class_alias($orig, 'Rougin\Dexter\Fixture\Http\PsrServerRequest');

/**
 * @package Dexter
 *
 * @method mixed                                                    getAttribute(string $name, $default = null)
 * @method array<string, string>                                    getAttributes()
 * @method array<string, string>                                    getCookieParams()
 * @method array<string, mixed>|object|null                         getParsedBody()
 * @method array<string, string>                                    getQueryParams()
 * @method array<string, string>                                    getServerParams()
 * @method array<string, \Psr\Http\Message\UploadedFileInterface[]> getUploadedFiles()
 * @method \Psr\Http\Message\ServerRequestInterface                 withAttribute(string $name, $value)
 * @method \Psr\Http\Message\ServerRequestInterface                 withCookieParams(array<string, string> $cookies)
 * @method \Psr\Http\Message\ServerRequestInterface                 withoutAttribute(string $name)
 * @method \Psr\Http\Message\ServerRequestInterface                 withParsedBody($data)
 * @method \Psr\Http\Message\ServerRequestInterface                 withQueryParams(array<string, string> $query)
 * @method \Psr\Http\Message\ServerRequestInterface                 withUploadedFiles(array<string, \Psr\Http\Message\UploadedFileInterface[]> $uploadedFiles)
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ServerRequest extends PsrServerRequest implements ServerRequestInterface
{
    /**
     * Initializes the server request instance.
     *
     * @param array<string, string> $server
     */
    public function __construct(array $server)
    {
        parent::__construct($server);
    }
}
