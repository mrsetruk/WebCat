<?php
/**
 * Base model
 *
 * PHP version 7.0
 */
abstract class Model
{
    /**
     * Get the PDO database connection
     *
     * @return mixed
     */
    protected static function getDB()
    {
        static $db = null;
        if ($db === null) {
            $dsn = 'mysql:host=' . ConfigurationOld::get('DB_HOST') . ';dbname=' . ConfigurationOld::get('DB_NAME') . ';charset=utf8';
            $db = new PDO($dsn, ConfigurationOld::get('DB_USER'), ConfigurationOld::get('DB_PASSWORD'));
            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return $db;
    }
}