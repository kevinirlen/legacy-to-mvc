<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BaseController
{
    protected Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Render a template using Twig
     *
     * @param string $view
     * @param array  $parameters
     *
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function render(string $view, array $parameters = []): Response
    {
        // What the heck are those two lines???
        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
        $twig   = new \Twig\Environment($loader);

        $parameters['base_url'] = $this->baseUrl();

        $content = $twig->render($view, $parameters);
        $response = new Response($content);
        $response->send();

        return $response;
    }

    /**
     * A little helper to get the base url
     * @return string
     */
    public function baseUrl() : string
    {
        $request = Request::createFromGlobals();

        return 'http://' .$request->server->get('HTTP_HOST');
    }
}