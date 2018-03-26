<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-17
 * Time: 11:46
 */

namespace App\Models;


use Core\ORM\Model;

class ReferenceAuthType extends  Model{
    protected static $_tableName = 'ref_authentification_types';
    protected static $_primaryKey = 'code';
    protected static $_relations = array();

    protected static $_tableFields = array(
        'description',
    );

    public $code;
    public $description = "";

    protected static function defineRelations()
    {
        self::addRelationOneToMany('code', '\App\Models\Catalog', 'ref_authentification_type_code');
    }
}