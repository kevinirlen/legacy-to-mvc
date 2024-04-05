<?php

namespace App\Controller;

class AboutController extends BaseController
{
    public function index()
    {
        return $this->render('pages/about_us.html.twig');
    }
}