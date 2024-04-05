<?php

namespace App\Controller;

use App\Manager\ProductManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductsController extends BaseController
{
    private ProductManager $productManager;

    /**
     * @param Request $request
     * @param ProductManager $productManager
     */
    public function __construct(Request $request, ProductManager $productManager)
    {
        parent::__construct($request);

        $this->productManager = $productManager;
    }

    /**
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function index(): Response
    {
        $products = $this->productManager->findAll();

        return $this->render('products/list.html.twig', [
            'products' => $products,
        ]);
    }

    /**
     * @param array $params
     * @return Response
     * @throws \Twig\Error\LoaderError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     */
    public function item(array $params = []): Response
    {
        // No parameters? Let's get mad.
        if (empty($params)) {
            throw new \Exception('Hey, what are you trying to achieve here??');
        }

        $id = $params[0];

        $product = $this->productManager->find($id);

        return $this->render('products/item.html.twig', [
            'product' => $product,
        ]);
    }
}