<?php

namespace Rougin\Dexter\Fixture\Routes;

use Rougin\Dexter\Route;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Tset extends Route
{
    /**
     * @var boolean
     */
    protected $valid = true;

    /**
     * @return self
     */
    public function setAsInvalid()
    {
        $this->valid = false;

        return $this;
    }

    /**
     * Checks if the specified item can be deleted.
     *
     * @param integer $id
     *
     * @return boolean
     */
    protected function isDeleteValid($id)
    {
        return $this->valid;
    }

    /**
     * Checks if the specified item is allowed to be returned.
     *
     * @param integer              $id
     * @param array<string, mixed> $params
     *
     * @return boolean
     */
    protected function isShowValid($id, $params)
    {
        return $this->valid;
    }

    /**
     * Checks if the action is valid.
     *
     * @param array<string, mixed> $data
     * @param integer              $id
     *
     * @return boolean
     */
    protected function isValid($data, $id = 0)
    {
        return $this->valid;
    }
}
