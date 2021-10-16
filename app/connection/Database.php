<?php

namespace App\Connection;

use mysqli;

class Database
{
    public $conn = null;

    function __construct()
    {
        $this->connectDB();
    }

    // connect DB with mysqli
    private function connectDB()
    {
        try {
            $this->conn = new mysqli(DB_SERVER, DB_USER_NAME, DB_PASSWORD, DB_NAME);

            $this->conn->set_charset(DB_CHARSET);
        } catch (\Exception $e) {
            exit('Connect to database fail !');
        }
    }

    // close connect to mysql
    public function closeDB()
    {
        if ($this->conn) {
            return $this->conn->close();
        }
    }
}
