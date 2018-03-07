<?php

/**
 * Home controller
 *
 * PHP version 7.0
 */
class Catalog extends Controller
{

    public function access($catalog)
    {
    	// Load Parameter catalog


        // Verified auth Type (Public, protected, private)


        // Load ConfigOld

        View::renderTemplate('catalog/index.html');

    }
}