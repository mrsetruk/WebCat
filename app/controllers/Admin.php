<?php

namespace App\Controllers;
use Core\{
    Controller,
    View
};

/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2/6/2018
 * Time: 8:14 AM
 */
class Admin extends Controller
{
    public function dashboard()
    {
        View::renderTemplate('admin/index.html');

    }

    function login(){
        View::renderTemplate('admin/login.html', array('scope' => $this->scope));
    }
}