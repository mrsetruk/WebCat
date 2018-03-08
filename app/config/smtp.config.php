<?php
/**
 * Created by PhpStorm.
 * User: DEV
 * Date: 2018-03-07
 * Time: 14:32
 */

return [
    /**
     * Configuration for: Email server credentials
     * Emails are sent using SMTP, Don't use built-in mail() function in PHP.
     *
     */
    'email_smtp_debug' => 2,
    'email_smtp_auth' => true,
    'email_smtp_secure' => 'ssl',
    'email_smtp_host' => 'YOURSMTPHOST',
    'email_smtp_port' => 465,
    'email_smtp_username' => 'YOURUSERNAME',
    'email_smtp_password' => 'YOURPASSWORD',
    'email_from' => 'info@YOURDOMAIN.com',
    'email_from_name' => '',
    'email_reply_to' => 'no-reply@YOURDOMAIN.com',
    'admin_email' => 'YOUREMAIL',
];