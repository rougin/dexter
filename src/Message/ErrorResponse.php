<?php

namespace Rougin\Dexter\Message;

use Rougin\Slytherin\Http\Response;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class ErrorResponse extends Response
{
    /**
     * @var integer
     */
    protected $code = 400;
}
