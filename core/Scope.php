<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-18
 * Time: 14:50
 */

namespace Core;


class Scope implements \Serializable
{

    private static $_instance = null;

    final private function __construct() {

    }

    /**
     * Singleton instance getter
     *
     * @return Scope
     */
    public static function getInstance() {
        if (self::$_instance === null) {
            self::$_instance = new Scope();
        }

        return self::$_instance;
    }

    /**
     * String representation of object
     * @link http://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize(get_object_vars($this));
    }

    /**
     * Constructs the object
     * @link http://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        self::getInstance();

        // Set our values
        if (is_array($serialized)) {
            foreach ($serialized as $k => $v) {
                $this->$k = $v;
            }
        }
    }
}