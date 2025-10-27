<?php

namespace Rougin\Dexter;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Filter extends Input
{
    /**
     * @var string[]
     */
    protected $keys = array();

    /**
     * @return string[]
     */
    public function getSearchKeys()
    {
        return $this->keys;
    }

    /**
     * @param string  $name
     * @param boolean $value
     *
     * @return self
     */
    public function setBool($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @param string  $name
     * @param integer $value
     *
     * @return self
     */
    public function setInt($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @param float  $value
     *
     * @return self
     */
    public function setFloat($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @param string $name
     * @param string $value
     *
     * @return self
     */
    public function setStr($name, $value)
    {
        $this->data[$name] = $value;

        return $this;
    }

    /**
     * @param string|string[] $keys
     *
     * @return self
     */
    public function withSearch($keys)
    {
        if (is_string($keys))
        {
            $keys = array($keys);
        }

        $this->keys = $keys;

        return $this;
    }
}
