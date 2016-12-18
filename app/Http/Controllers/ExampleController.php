<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function show(Request $request, $id)
    {
        return "Hi " .$id;
    }

    //
}
