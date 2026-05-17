<?php

namespace Rougin\Dexter\Fixture\Routes;

use Rougin\Dexter\Http\Response;
use Rougin\Dexter\Route;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Unified extends Route
{
    /**
     * @var integer
     */
    protected $code = 0;

    /**
     * @var array<string, mixed>|null
     */
    protected $data = null;

    /**
     * @var integer|null
     */
    protected $id = null;

    /**
     * @var boolean
     */
    protected $valid = true;

    /**
     * @return integer
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return integer|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return self
     */
    public function setAsInvalid()
    {
        $this->valid = false;

        return $this;
    }

    /**
     * @param integer $code
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function invalid($code = 400)
    {
        $this->code = $code;

        $data = array('data' => 'invalid');

        $data['code'] = $code;

        return Response::toJson($data, $code);
    }

    /**
     * @param array<string, mixed> $data
     * @param integer              $id
     *
     * @return boolean
     */
    protected function isValid($data, $id = 0)
    {
        $this->data = $data;

        $this->id = $id;

        return $this->valid;
    }
}
