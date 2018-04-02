<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-17
 * Time: 10:33
 */

namespace App\Models;


use Core\ORM\Model;
use JsonSerializable;

class Catalog extends Model implements JsonSerializable {
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
        self::addRelationOneToOne('ref_authentification_type_code', '\App\Models\ReferenceAuthType', 'code', 'description');
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
        return [
            'id' => $this->id,
            'name' => $this->name,
            'auth_type' => $this->ref_authentification_type_code
        ];
    }
}