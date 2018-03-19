<?php
/**
 * Created by PhpStorm.
 * User: Galbanie
 * Date: 2018-03-18
 * Time: 09:10
 */

namespace Core;


use PDO;
use SessionHandlerInterface;

class SessionHandler implements SessionHandlerInterface
{

    /**
     * a PDO connection resource
     * @var PDO
     */
    protected $dbh;
    /**
     * the name of the DB table which handles the sessions
     * @var string
     */
    protected $dbTable;

    /**
     * SessionHandler constructor.
     * @param PDO $dbh
     * @param string $dbTable
     */
    public function __construct(PDO $dbh, $dbTable = 'sessions')
    {
        $this->dbh = $dbh;
        $this->dbTable = $dbTable;

        session_set_save_handler($this,true);
        register_shutdown_function('session_write_close');
        session_start();
    }

    /**
     * Inject PDO from outside
     * @param object $dbh expects PDO object
     */
    public function setPDO($dbh) {
        $this->dbh = $dbh;
    }
    /**
     * Set MySQL table to work with
     * @param string $dbTable
     */
    public function setDbTable($dbTable) {
        $this->dbTable = $dbTable;
    }

    /**
     * Close the session
     * @link http://php.net/manual/en/sessionhandlerinterface.close.php
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function close()
    {
        $this->dbh = null;
        return true;
    }

    /**
     * Destroy a session
     * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
     * @param string $session_id The session ID being destroyed.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function destroy($session_id)
    {
        $stmt = $this->dbh->prepare("DELETE FROM {$this->dbTable} WHERE id=:id");
        $ret = $stmt->execute(array(
            ':id' => $session_id
        ));
//        echo __FUNCTION__;
//        var_dump($ret);
        return $ret;
    }

    /**
     * Cleanup old sessions
     * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
     * @param int $maxlifetime <p>
     * Sessions that have not updated for
     * the last maxlifetime seconds will be removed.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function gc($maxlifetime)
    {
        $stmt = $this->dbh->prepare("DELETE FROM {$this->dbTable} WHERE timestamp < :limit");
        $ret = $stmt->execute(array(':limit' => time() - intval($maxlifetime)));
        return $ret;
    }

    /**
     * Initialize session
     * @link http://php.net/manual/en/sessionhandlerinterface.open.php
     * @param string $save_path The path where to store/retrieve the session.
     * @param string $name The session name.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function open($save_path, $name)
    {
        if($this->dbh){
            return true;
        }
        return false;
    }

    /**
     * Read session data
     * @link http://php.net/manual/en/sessionhandlerinterface.read.php
     * @param string $session_id The session id to read data for.
     * @return string <p>
     * Returns an encoded string of the read data.
     * If nothing was read, it must return an empty string.
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function read($session_id)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM {$this->dbTable} WHERE id=:id");
        $stmt->execute(array(':id' => $session_id));
        $session = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($session) {
            $ret = $session['data'];
        } else {
            $ret = '';
        }
        return $ret;
    }

    /**
     * Write session data
     * @link http://php.net/manual/en/sessionhandlerinterface.write.php
     * @param string $session_id The session id.
     * @param string $session_data <p>
     * The encoded session data. This data is the
     * result of the PHP internally encoding
     * the $_SESSION superglobal to a serialized
     * string and passing it as this parameter.
     * Please note sessions use an alternative serialization method.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function write($session_id, $session_data)
    {
        $stmt = $this->dbh->prepare("REPLACE INTO {$this->dbTable} (id,data,timestamp) VALUES (:id,:data,:timestamp)");
        $ret = $stmt->execute(
            array(':id' => $session_id,
                ':data' => $session_data,
                'timestamp' => time()
            )
        );
        return $ret;
    }
}