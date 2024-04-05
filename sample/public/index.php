<?php

//ini_set('session.use_cookies', 1);
//session_start();

use App\Application;
use Symfony\Component\HttpFoundation\Request;

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/Container.php';

$debug = true;
$request = Request::createFromGlobals();

try {
    /** @var \DI\Container $container */
    $app = new Application($request, $container);

    // Boot up the system. The most important line in life.
    $app->execute();
} catch (\Symfony\Component\HttpKernel\Exception\NotFoundHttpException $e) {
    // Explosion ! KABOOM!!!
    // A better approach is to use the `$this->>createNotFoundException()` ... Lack of time...
    // Or if you are lazy, just return `http_response_code(404)` .. since the route does not exist.

    echo $e->getMessage() . '<br />';
    die;
} catch (Exception $e) {
    // Another Explosion. Double KABOOM
    if ($debug) {
        dump($e);
    }
}
