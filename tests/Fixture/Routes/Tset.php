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
     * Checks if the action is allowed.
     *
     * @param array<string, mixed> $data
     * @param integer              $id
     *
     * @return boolean
     */
    protected function isAllowed($data, $id = 0)
    {
        return $this->valid;
    }
}
