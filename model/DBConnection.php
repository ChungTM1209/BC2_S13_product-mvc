<?php
/**
 * Created by PhpStorm.
 * User: chungtran
 * Date: 13/02/2019
 * Time: 14:04
 */

namespace Model;

use PDO;
use Exception;

class DBConnection
{
    public $dsn;
    public $username;
    public $password;

    public function __construct($dsn, $username, $password)
    {
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
    }

    public function connect()
    {
        $conn = null;
        try {
            $conn = new PDO($this->dsn, $this->username, $this->password);
        } catch (Exception $exception) {
            echo($exception->getMessage());
        }

        return $conn;
    }
}