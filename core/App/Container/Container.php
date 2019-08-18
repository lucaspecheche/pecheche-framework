<?php

namespace Core\App\Container;

use Core\App\Exceptions\UnableToResolveClass;
use ReflectionClass;

class Container
{
    public function resolve(string $class): object
    {
        $reflection = new ReflectionClass($class);
        return $this->resolving($reflection);
    }

    private function resolving(ReflectionClass $class)
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

                $received = $this->resolving($makeNext);
                $dependencies[] = $received;
            }

            return $class->newInstanceArgs($dependencies);
        }
        $className = $class->getName();
        return new $className;
    }

}