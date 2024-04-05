<?php

namespace App\Contracts;

interface ControllerResolverInterface
{
    public function setController(string $controller);
    public function setAction(string $action);
    public function setParameters(array $parameters);
    public function handleUri();
    public function execute();
}