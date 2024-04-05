<?php

use Twig\Environment;
use Symfony\Component\HttpFoundation\Request;
use Twig\Loader\FilesystemLoader;

$containerBuilder = new \DI\ContainerBuilder();
$containerBuilder->addDefinitions(__DIR__ . '/../config/database.php');
$container = $containerBuilder->build();

$loader = new FilesystemLoader(__DIR__ . '/../templates');

// Set the Twig Environment and HttpFoundtion Request inside the container.
// Note that we use the FQCN as the KEY here, This is a better approach, since we can inject the class
// without injecting the whole container.
$container->set(Environment::class, new Environment($loader));
$container->set(Request::class, Request::createFromGlobals());

return $container;