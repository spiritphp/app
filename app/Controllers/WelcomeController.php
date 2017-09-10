<?php

namespace App\Controllers;

use Spirit\Structure\Controller;

class WelcomeController extends Controller
{

    public function index()
    {
        return $this->view('welcome/index');
    }

}