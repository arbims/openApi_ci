<?php

namespace App\Controllers;

class SwaggerDocController extends BaseController {

    public function index()
    {
        return view('swagger/index');
    }
}