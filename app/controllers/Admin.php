<?php

/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2/6/2018
 * Time: 8:14 AM
 */
class Admin extends Controller
{
    public function access()
    {
        View::renderTemplate('admin/index.html');

    }
}