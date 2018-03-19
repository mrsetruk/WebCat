<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-18
 * Time: 12:21
 */

namespace App\Models;


use Core\ORM\Model;

class Staff extends Model
{
    protected static $_tableName = 'jnp_admin_access';
    protected static $_primaryKey = 'id';

    protected static $_tableFields = array(
        'name',
        'username',
        'password',
        'email'
    );

    public $id;
    public $name;
    public $username;
    public $password;
    public $email;
}