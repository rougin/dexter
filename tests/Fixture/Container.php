<?php

namespace Rougin\Dexter\Fixture;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Container
{
    /**
     * @var array<string, mixed>
     */
    protected $items = array();

    /**
     * Finds an entry by its identifier and returns it.
     * If not stored, uses reflection to autowire.
     *
     * @param string $id
     *
     * @return mixed
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function get($id)
    {
        if ($this->has($id))
        {
            return $this->items[$id];
        }

        /** @var class-string $id */
        $reflect = new \ReflectionClass($id);

        $args = array();

        if ($const = $reflect->getConstructor())
        {
            $args = $this->resolve($const);
        }

        return $reflect->newInstanceArgs($args);
    }

    /**
     * Returns true if the container has the given item.
     *
     * @param string $id
     *
     * @return boolean
     */
    public function has($id)
    {
        return isset($this->items[$id]);
    }

    /**
     * Sets a new instance to the container.
     *
     * @param string $id
     * @param mixed  $concrete
     *
     * @return self
     */
    public function set($id, $concrete)
    {
        $this->items[$id] = $concrete;

        return $this;
    }

    /**
     * Resolves constructor parameters via reflection.
     *
     * @param \ReflectionMethod $reflect
     *
     * @return array<integer, mixed>
     */
    protected function resolve(\ReflectionMethod $reflect)
    {
        $items = $reflect->getParameters();

        $result = array();

        foreach ($items as $key => $param)
        {
            if ($class = $this->getParam($param))
            {
                $name = $class->getName();

                $result[$key] = $this->get($name);
            }
        }

        return $result;
    }

    /**
     * Returns the ReflectionClass for a parameter,
     * compatible with PHP 5.3 through 8.x.
     *
     * @param \ReflectionParameter $param
     *
     * @return \ReflectionClass<object>|null
     */
    protected function getParam(\ReflectionParameter $param)
    {
        $php8 = version_compare(PHP_VERSION, '8.0.0', '>=');

        if (! $php8)
        {
            $fn = array($param, 'getClass');

            return call_user_func($fn);
        }

        $fn = array($param, 'getType');

        $type = call_user_func($fn);

        $builtIn = true;

        if ($type)
        {
            /** @var callable */
            $fn = array($type, 'isBuiltin');

            /** @var boolean */
            $builtIn = call_user_func($fn);
        }

        if ($builtIn)
        {
            return null;
        }

        /** @var callable */
        $class = array($type, 'getName');

        /** @var class-string */
        $fn = call_user_func($class);

        return new \ReflectionClass($fn);
    }
}
