<?php


namespace App\Controllers;
use App\Models\Reference_Auth_Type;
use Core\{
    Config, Controller, DatabaseAdapter, ORM\ORM, Session, View
};


/**
 * Home controller
 *
 * PHP version 7.0
 */
class Catalog extends Controller
{


    public function index($catalog)
    {
    	// Load catalog

//        $ref_auth_type = new Reference_Auth_Type();
//        $ref_auth_type->code = "Private";
//        $ref_auth_type->save();
//        $ref = Reference_Auth_Type::findOne(array('code' => 'Protected'));

        $cat = \App\Models\Catalog::findOne(array('name' => $catalog));

        var_dump($cat);

        if(!$cat){
            header('location: /');
            exit();
        }

        // Verified auth Type (Public, protected, private)
        if($cat->ref_authentification_type_code === 'Private'){
            header('location: /login');
            exit();
        }


        View::renderTemplate('catalog/index.html',array(
            'scope' => $this->scope,
            'catalog' => $cat
        ));

    }

    function login(){
        View::renderTemplate('catalog/login.html', array('scope' => $this->scope));
    }
}