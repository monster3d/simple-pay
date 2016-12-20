<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    /**
    *
    * Check result
    *
    */
    public function isFound($result)
    {
        if (count($result) === 0 ) {
            abort(404);
        }
    } 
}
