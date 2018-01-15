<?php

function init(&$mysqlConnection, $databaseName, $tableName) {

    $statement = "CREATE DATABASE IF NOT EXISTS $databaseName";
    if ($mysqlConnection->query($statement) === FALSE) {
        echo ( "Error creating database: " . $mysqlConnection->error );
    } else {

        if ($mysqlConnection->select_db($databaseName)) {
        }

        if ($mysqlConnection->query("CREATE TABLE IF NOT EXISTS $tableName ("
                        . "ID INT AUTO_INCREMENT PRIMARY KEY,"
                        . "task VARCHAR(255) NOT NULL"
                        . ")") === TRUE) {

        }
    }
}
