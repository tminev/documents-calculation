<?php

namespace Helper;

use ReflectionClass;

/**
 * Class Unit
 *
 * all public methods declared in this helper class will be available in $I
 */
class Unit extends \Codeception\Module
{
    /**
     * Calls the given private or protected method and returns its result
     *
     * @param string $methodName
     * @param Object $object
     * @param array $args
     *
     * @return mixed
     */
    public function callPrivateOrProtectedMethod(
        string $methodName,
        $object,
        array $args = []
    ) {
        $class = new ReflectionClass($object);
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);

        $result = $method->invokeArgs($object, $args);

        unset($method, $class);

        return $result;
    }
}