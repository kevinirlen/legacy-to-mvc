<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Request;

trait HelperTrait
{
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