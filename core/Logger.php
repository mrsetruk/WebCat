<?php

/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 1/31/2018
 * Time: 3:25 PM
 */
class Logger
{
    /**
     * Constructor
     *
     */
    private function __construct(){}
    /**
     * log
     *
     * @access public
     * @static static method
     * @param  string  $header
     * @param  string  $message
     * @param  string  $filename
     * @param  string  $linenum
     */
    public static function log($header="", $message="", $filename="", $linenum=""){
        $config = new Config(require(CONFIG_PATH));
        $logfile = $config->get('base_dir') . "/logs/log.txt";
        $date = date("d/m/Y G:i:s");
        $err = $date." | ".$filename." | ".$linenum." | ".$header. "\n";
        $message = is_array($message)? implode("\n", $message): $message;
        $err .= $message . "\n*******************************************************************\n\n";
        // log/write error to log file
        error_log($err, 3, $logfile);
    }
}