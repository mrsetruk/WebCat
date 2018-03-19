<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-18
 * Time: 17:45
 */

namespace App\Controllers;


use Core\Controller;
use Core\View;

class Auth extends Controller
{
    function staff_login(){
        View::renderTemplate('auth/login-staff.html', array(
            'scope' => $this->scope,
            'css' => [
                'class' => [
                    'body' => 'bg-dark'
                ]
            ]
        ));
    }

    function login(){
        View::renderTemplate('auth/login.html', array('scope' => $this->scope));
    }
}