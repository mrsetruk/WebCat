<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-18
 * Time: 12:23
 */

namespace App\Controllers;


use Core\Controller;
use Core\View;

class Staff extends Controller
{
    private $sections = [
        'index' => 'staff/index.html',
        'clients' => 'staff/clients.html'
    ];

    function dashboard($section = 'index'){
        $staff = false;
        if($this->session->get('staff_id')){
            $staff = \App\Models\Staff::findOne([
                'id' => $this->session->get('staff_id')
            ]);
        }
        if(!$staff){
            header('location: /staff/login');
            exit();
        }

        View::renderTemplate($this->sections[$section],array(
            'scope' => $this->scope,
            'css' => [
                'class' => [
                    'body' => 'fixed-nav sticky-footer bg-dark'
                ],
                'id' => [
                    'body' => 'page-top'
                ]
            ],
            'staff' => $staff
        ));
    }

    function login(){
        if(isset($this->request->getBodyParameters()['email']) and isset($this->request->getBodyParameters()['password'])){
            $staff = \App\Models\Staff::findOne([
                'email' => $this->request->getBodyParameter('email')
            ]);

            if($staff and ($staff->password === $this->request->getBodyParameter('password'))){
                $this->session->set('staff_id',$staff->id);
                header('location: /staff');
                exit();
            }
        }

        View::renderTemplate('staff/login.html', array(
            'scope' => $this->scope,
            'css' => [
                'class' => [
                    'body' => 'bg-dark'
                ]
            ]
        ));

    }
}