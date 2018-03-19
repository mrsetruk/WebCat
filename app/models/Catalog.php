<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-17
 * Time: 10:33
 */

namespace App\Models;


use Core\ORM\Model;

class Catalog extends Model {
    protected static $_tableName = 'catalog';
    protected static $_primaryKey = 'id';
    protected static $_relations = array();

    protected static $_tableFields = array(
        'name',
        'ref_authentification_type_code'
    );

    public $id;
    public $name;
    public $ref_authentification_type_code;

    protected static function defineRelations()
    {
        self::addRelationOneToOne('ref_authentification_type_code', '\App\Models\Reference_Auth_Type', 'code', 'description');
    }
}