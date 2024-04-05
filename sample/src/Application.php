<?php

namespace App;

use App\Contracts\ControllerResolverInterface;
use DI\Container;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This is the entry point to control all request and load up the correct controller.
 * Controllers are handled by a Dependency Injection container..
 *
 * Class Application
 * @package App
 */
class Application implements ControllerResolverInterface
{
    const DEFAULT_CONTROLLER = 'index';
    const DEFAULT_ACTION     = 'index';

    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $parameters    = [];
    protected $basePath      = 'index.php';

    /**
     * @var Request
     */
    private $request;
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Request   $request
     * @param Container $container
     */
    public function __construct(Request $request, Container $container)
    {
        $this->request = $request;
        $this->container = $container;
    }

    /**
     * Trying to determine to correct controller based on the path itself.
     *
     * @param string $controller
     *
     * @return ControllerResolverInterface
     */
    public function setController(string $controller): ControllerResolverInterface
    {
        // I.e: App\Controller\IndexController
        $controllerFQCN = 'App\\Controller\\' . ucfirst(strtolower($controller)) . "Controller";

        // No need to go further.
        if (!class_exists($controllerFQCN)) {
            throw new NotFoundHttpException('The requested page does not exist. Trying to load controller: ' . $controllerFQCN . ' ! Did you forget to create the controller ? Please check inside "src/Controller" directory.');
        }

        $this->controller = $controllerFQCN;

        return $this;
    }

    /**
     * @param string $action
     * @return $this
     * @throws \ReflectionException
     */
    public function setAction(string $action): ControllerResolverInterface
    {
        // Kind of different, we read our Controller class first.
        // This is super handy, because The ReflectionClass class gives us metadata about our Controller.
        // We get total control.
        $reflector = new \ReflectionClass($this->controller);

        if (!$reflector->hasMethod($action)) {
            throw new NotFoundHttpException("The Controller class " . $this->controller ." was found ! But no method called '$action' exists inside controller : " . $this->controller . '. Did you forget to create a method called: ' . $action . '?');
        }

        $this->action = $action;

        return $this;
    }

    public function setParameters(array $parameters): ControllerResolverInterface
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Parse the URI so we can grab the correct Controller/Action/Parameters
     *
     * @throws \ReflectionException
     */
    public function handleUri()
    {
        $path = trim(parse_url($this->request->server->get('REQUEST_URI'), PHP_URL_PATH), "/");

        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);

        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }

        // Get the controller, action and params from the url
        @list($controller, $action, $params) = explode("/", $path, 3);

        if (empty($controller)) {
            $controller = self::DEFAULT_CONTROLLER;
        }

        if (isset($controller)) {
            $this->setController($controller);
        }

        if (isset($action)) {
            $this->setAction($action);
        }

        if (isset($params)) {
            $this->setParameters(explode("/", $params));
        }
    }

    /**
     * Bring the system up.
     *
     * @return mixed
     * @throws \ReflectionException
     */
    public function execute()
    {
        $this->handleUri();

        // The container exposes a call() method that can invoke any PHP callable.
        // It offers the following additional features over using call_user_func()
        return $this->container->call([$this->controller, $this->action], [$this->parameters]);
    }
}