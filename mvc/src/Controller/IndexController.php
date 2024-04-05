<?php

namespace App\Controller;

use App\Manager\ProductManager;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends BaseController
{
    public function index()
    {
        return $this->render('home/index.html.twig');
    }
}