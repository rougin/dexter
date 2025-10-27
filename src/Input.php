<?php

namespace Rougin\Dexter;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Input
{
    /**
     * @var array<string, mixed>
     */
    protected $data = array();

    /**
     * @param array<string, mixed> $data
     */
    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     *
     * @return boolean
     */
    public function asBool($key)
    {
        $bool = FILTER_VALIDATE_BOOLEAN;

        $item = $this->getItem($key);

        $item = filter_var($item, $bool);

        return $item === true;
    }

    /**
     * @param string $key
     *
     * @return float|null
     */
    public function asFloat($key)
    {
        $null = FILTER_NULL_ON_FAILURE;

        $int = FILTER_VALIDATE_FLOAT;

        $item = $this->getItem($key);

        $item = filter_var($item, $int, $null);

        return is_float($item) ? $item : null;
    }

    /**
     * @param string $key
     *
     * @return integer|null
     */
    public function asInt($key)
    {
        $null = FILTER_NULL_ON_FAILURE;

        $int = FILTER_VALIDATE_INT;

        $item = $this->getItem($key);

        $item = filter_var($item, $int, $null);

        return is_int($item) ? $item : null;
    }

    /**
     * @param string $key
     *
     * @return string|null
     */
    public function asStr($key)
    {
        $item = $this->getItem($key);

        return is_string($item) ? $item : null;
    }

    /**
     * @param string $key
     *
     * @return float
     */
    public function asTrueFloat($key)
    {
        $item = $this->asFloat($key);

        if (! is_float($item))
        {
            $text = 'Key "' . $key . '" is not an integer';

            throw new \Exception($text);
        }

        return $item;
    }

    /**
     * @param string $key
     *
     * @return integer
     */
    public function asTrueInt($key)
    {
        $item = $this->asInt($key);

        if (! is_int($item))
        {
            $text = 'Key "' . $key . '" is not an integer';

            throw new \Exception($text);
        }

        return $item;
    }

    /**
     * @param string $key
     *
     * @return string
     */
    public function asTrueStr($key)
    {
        $item = $this->asStr($key);

        if (! is_string($item))
        {
            $text = 'Key "' . $key . '" is not a string';

            throw new \Exception($text);
        }

        return $item;
    }

    /**
     * @return array<string, mixed>
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    public function getItem($key)
    {
        $exists = array_key_exists($key, $this->data);

        return $exists ? $this->data[$key] : null;
    }
}
