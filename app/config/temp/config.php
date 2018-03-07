<?php
/**
 * Created by PhpStorm.
 * User: Marc
 * Date: 2/1/2018
 * Time: 6:22 AM
 */

return array(
    /**
     * Configuration for: Database Connection
     * Define database constants to establish a connection.
     *
     * It's important to set the charset for the database
     *
     * In the real world, you will have a database user with limited privileges(usually only CRUD).
     *
     */
    "DB_HOST" =>"localhost",
    "DB_NAME" => "",
    "DB_USER" => "root",
    "DB_PASS" => "",
    'DB_CHARSET' => 'utf8',
    /**
     * Configuration for: Cookies
     *
     * COOKIE_RUNTIME: How long should a cookie be valid by seconds.
     *      - 1209600 means 2 weeks
     *      - 604800 means 1 week
     * COOKIE_DOMAIN: The domain where the cookie is valid for.
     *      COOKIE_DOMAIN mightn't work with "localhost", ".localhost", "127.0.0.1", or ".127.0.0.1". If so, leave it as empty string, false or null.
     *      @see http://stackoverflow.com/questions/1134290/cookies-on-localhost-with-explicit-domain
     *      @see http://php.net/manual/en/function.setcookie.php#73107
     *
     * COOKIE_PATH: The path where the cookie is valid for. If set to '/', the cookie will be available within the entire COOKIE_DOMAIN.
     * COOKIE_SECURE: If the cookie will be transferred through secured connection(SSL). It's highly recommended to set it to true if you have secured connection
     * COOKIE_HTTP: If set to true, Cookies that can't be accessed by JS - Highly recommended!
     * COOKIE_SECRET_KEY: A random value to make the cookie more secure.
     *
     */
    "COOKIE_EXPIRY" => 1209600,
    "SESSION_COOKIE_EXPIRY" => 604800,
    "COOKIE_DOMAIN" => '',
    "COOKIE_PATH" => '/',
    "COOKIE_SECURE" => false,
    "COOKIE_HTTP" => true,
    "COOKIE_SECRET_KEY" => "af&70-GF^!a{f64r5@g38l]#kQ4B+43%",
    /**
     * Configuration for: Encryption Keys
     *
     */
    "ENCRYPTION_KEY" => "3¥‹a0cd@!$251Êìcef08%&",
    "HMAC_SALT" => "a8C7n7^Ed0%8Qfd9K4m6d$86Dab",
    "HASH_KEY" => "z4D8Mp7Jm5cH",
    /**
     * Configuration for: Email server credentials
     * Emails are sent using SMTP, Don't use built-in mail() function in PHP.
     *
     */
    "EMAIL_SMTP_DEBUG" => 2,
    "EMAIL_SMTP_AUTH" => true,
    "EMAIL_SMTP_SECURE" => "ssl",
    "EMAIL_SMTP_HOST" => "YOURSMTPHOST",
    "EMAIL_SMTP_PORT" => 465,
    "EMAIL_SMTP_USERNAME" => "YOURUSERNAME",
    "EMAIL_SMTP_PASSWORD" => "YOURPASSWORD",
    "EMAIL_FROM" => "info@YOURDOMAIN.com",
    "EMAIL_FROM_NAME" => "",
    "EMAIL_REPLY_TO" => "no-reply@YOURDOMAIN.com",
    "ADMIN_EMAIL" => "YOUREMAIL",
    /**
     * Configuration for: Hashing strength
     *
     * It defines the strength of the password hashing/salting. "10" is the default value by PHP.
     * @see http://php.net/manual/en/function.password-hash.php
     *
     */
    "HASH_COST_FACTOR" => "10",
    /**
     * Configuration for: Pagination
     *
     */
    "PAGINATION_DEFAULT_LIMIT" => 10
);