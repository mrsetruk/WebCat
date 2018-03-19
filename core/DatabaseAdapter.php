<?php

namespace Core;
use Closure;
use PDO;

/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 07:38
 */

class DatabaseAdapter
{
    protected $inhibitor = null;
    protected $instance = null;

    private $name;
    private $username;
    private $password;
    private $hostname = '127.0.0.1';
    private $port = '3306';

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->inhibitor = Closure::bind(
            function ($name = null, $username = null, $password = null, $hostname = null, $port = null): PDO {
                return new PDO(
                    'mysql:dbname='.($name ?? $this->name).';host='.($hostname ?? $this->hostname).';port='.($port ?? $this->port),
                    $username ?? $this->username,
                    $password ?? $this->password
                );
            },
            $this,
            DatabaseAdapter::class
        );
    }

    /**
     * Set database name.
     *
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * Set database username.
     *
     * @param string $username
     */
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    /**
     * Set database password.
     *
     * @param string $password
     */
    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    /**
     * Set database hostname.
     *
     * @param string $hostname
     */
    public function setHostname(string $hostname)
    {
        $this->hostname = $hostname;
    }

    /**
     * @param string $port
     */
    public function setPort(string $port)
    {
        $this->port = $port;
    }



    /**
     * Get Database adapter instance.
     *
     * @return DatabaseAdapter
     */
    public function getInstance(): PDO
    {
        if ($this->instance instanceof PDO) {
            return $this->instance;
        }

        return $this->instance = call_user_func($this->inhibitor);
    }
}