<?php

namespace App\Controller;

use App\Traits\HelperTrait;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class BaseController
{
    use HelperTrait;

    protected Request $request;
    private Environment $environment;

    /**
     * @param Request $request
     * @param Environment $environment
     */
    public function __construct(Request $request, Environment $environment)
    {
        $this->request = $request;
        $this->environment = $environment;
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
//        $loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/../../templates');
//        $twig   = new \Twig\Environment($loader);

        $parameters['base_url'] = $this->baseUrl();

        $content = $this->environment->render($view, $parameters);
        $response = new Response($content);
        $response->send();

        return $response;
    }
}