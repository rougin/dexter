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

        /** @phpstan-ignore-next-line */
        $reflect = new \ReflectionClass($id);

        $constructor = $reflect->getConstructor();

        if ($constructor === null)
        {
            return $reflect->newInstance();
        }

        $args = $this->resolve($constructor);

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
     * @param \ReflectionFunctionAbstract $reflection
     *
     * @return array<integer, mixed>
     */
    protected function resolve(\ReflectionFunctionAbstract $reflection)
    {
        $items = $reflection->getParameters();

        $result = array();

        foreach ($items as $key => $param)
        {
            $class = $this->getParameterClass($param);

            if ($class !== null && $this->has($class->getName()))
            {
                $result[$key] = $this->get($class->getName());

                continue;
            }

            try
            {
                $result[$key] = $param->getDefaultValue();
            }
            catch (\ReflectionException $e)
            {
                $result[$key] = null;
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
    protected function getParameterClass(\ReflectionParameter $param)
    {
        $php8 = version_compare(PHP_VERSION, '8.0.0', '>=');

        if (! $php8)
        {
            return call_user_func(array($param, 'getClass'));
        }

        $type = call_user_func(array($param, 'getType'));

        /** @phpstan-ignore-next-line */
        if ($type === null || call_user_func(array($type, 'isBuiltin')))
        {
            return null;
        }

        /** @var callable */
        $method = array($type, 'getName');

        /** @var class-string */
        $name = call_user_func($method);

        return new \ReflectionClass($name);
    }
}
