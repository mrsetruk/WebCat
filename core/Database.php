<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 07:36
 */

class Database {
    /**
     * @var DatabaseAdapter
     */
    private $adapter;

    /**
     * Constructor.
     *
     * @param DatabaseAdapter $adapter
     */
    public function __construct(DatabaseAdapter $adapter)
    {
        $this->adapter = $adapter;
    }
}