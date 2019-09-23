<?php

namespace P4\model;

class Manager
{
    protected function dbConnect()
    {
        $db = new \PDO('mysql:host=db5000178542.hosting-data.io;dbname=dbs173310;charset=utf8', 'dbu48109', 'Kill0007!');
        return $db;
    }
}
?>