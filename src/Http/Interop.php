<?php

namespace Rougin\Dexter\Http;

/**
 * @package Dexter
 *
 * @author Rougin Gutib <rougingutib@gmail.com>
 */
class Interop
{
    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    protected static function getClass()
    {
        return 'Psr\Http\Message\MessageInterface';
    }

    /**
     * @codeCoverageIgnore
     *
     * @return string
     */
    protected static function getMethod()
    {
        return 'getProtocolVersion';
    }

    /**
     * @return boolean
     */
    public static function isVersion2()
    {
        $class = static::getClass();

        $method = static::getMethod();

        $class = new \ReflectionMethod($class, $method);

        return method_exists($class, 'hasReturnType')
            && $class->hasReturnType();
    }

    /**
     * @param string $name
     *
     * @return void
     */
    public static function register($name)
    {
        $class = get_called_class();

        $pos = strrpos($class, '\\');

        $ns = $pos !== false ? substr($class, 0, $pos) : '';

        $num = static::isVersion2() ? '\V2' : '\V1';

        $orig = $ns . $num . '\\' . $name;

        class_alias($orig, $ns . '\Psr' . $name);
    }
}
