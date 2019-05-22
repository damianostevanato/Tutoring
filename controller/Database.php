<?php


class Database
{
    private static $connection;

    public static function getConnection()
    {
        if (!isset(self::$connection)) {
            $config = parse_ini_file('./controller/config.ini');
            try {
                $conn = new pdo('mysql:host=' . $config['hostname'] . ';dbname=' . $config['dbname'] . ';charset=utf8', $config['dbuser'], $config['dbpassword'], array(PDO::ATTR_PERSISTENT => true));
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection = $conn;

            } catch (PDOException $e) {
                echo $e;
                die();

            }

        }
        return self::$connection;
    }

}