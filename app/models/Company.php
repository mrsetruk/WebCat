<?php
/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 2018-04-02
 * Time: 12:29 PM
 */

namespace App\Models;


use Core\ORM\Model;
use JsonSerializable;

class Company extends Model implements JsonSerializable
{

    protected static $_tableName = 'company';
    protected static $_primaryKey = 'id';
    protected static $_relations = array();

    protected static $_tableFields = array(
        'name'
    );

    public $id;
    public $name;

    protected static function defineRelations()
    {
        self::addRelationOneToMany('id', '\App\Models\Catalog', 'company_id');
    }

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    function jsonSerialize()
    {
        // TODO: Implement jsonSerialize() method.
    }
}