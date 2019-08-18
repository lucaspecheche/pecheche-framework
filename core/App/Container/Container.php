<?php

namespace Core\App\Container;

use Core\App\Exceptions\UnableToResolveClass;
use ReflectionClass;

class Container
{
    public static function instance(string $controller, string $action, array $parameters)
    {
        return (new $controller)->$action($parameters);
    }

    public static function resolve(string $class)
    {
        $reflection = new ReflectionClass($class);
        return self::make($reflection);
    }

    private static function make(ReflectionClass $class)
    {
        $construct    = $class->getConstructor();
        $dependencies = [];

        if ($construct) {
            $parameters = $construct->getParameters();

            foreach ($parameters as $parameter) {
                if($parameter->allowsNull()) {
                    continue;
                }

                $makeNext = $parameter->getClass();

                if ($makeNext === null) {
                    throw new UnableToResolveClass();
                }

                $received = self::make($makeNext);
                $dependencies[] = $received;
            }

            return $class->newInstanceArgs($dependencies);
        }
        $className = $class->getName();
        return new $className;
    }

}