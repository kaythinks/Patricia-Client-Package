<?php

namespace PatriciaClient\Model;

use Dotenv\Dotenv;
use Composer\Composer;

class DatabaseManager
{

    public function __construct()
    {
        if ($this->getEnv()) {
            $dotenv = Dotenv::createImmutable($this->getProjectRoot());
            $dotenv->load();
            $this->dbName = $_ENV['DB_DATABASE'] ?? 'JilHQarrys';
            $this->dbUser = $_ENV['DB_USERNAME'] ?? 'root';
            $this->dbPassword = $_ENV['DB_PASSWORD'] ?? 'root';
            $this->dbHost = $_ENV['DB_HOST'] ?? '127.0.0.1';
            $this->dbPort = $_ENV['DB_PORT'] ?? '3306';
            $this->dbConnection = $_ENV['DB_CONNECTION'] ?? 'mysql';
            $this->pdoConnection = new \PDO(
                $this->dbConnection . ":host=" . $this->dbHost,
                $this->dbUser,
                $this->dbPassword
            );
            $this->createDataBase();
            $this->useDataBase();

            $this->pdoConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->pdoConnection->setAttribute(\PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);
        }
    }

    /**
     * creates a new table if the table doesn't exists
     * @return String
     */
    public function upTable($tableName, $attribute)
    {
        if (!$this->checkTable($tableName)) {
            $statement =  "CREATE TABLE " . $tableName . " ( " . $attribute . ")";
            try {

                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Table created successfully";
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }


    /**
     * drops a table if the table  exists
     * @return String
     */
    public function downTable($tableName)
    {
        if ($this->checkTable($tableName)) {
            $statement =  "DROP TABLE " . $tableName;
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Table dropped successfully";
            } catch (\PDOException $e) {
            }
        }
    }

     /**
     * inserts into table if the table  exists
     * @return String
     */
    public function insertIntoTable($tableName, $array)
    {
        if ($this->checkTable($tableName)) {
            $attribute = join(', ', array_keys($array));
            $value = str_replace(str_split("[]"), "", json_encode(array_values($array)));
            $statement =  "INSERT INTO " . $tableName . " ( " . $attribute .
                ") VALUES (" . $value . ")";
            try {
                $query = $this->pdoConnection->prepare($statement);
                $query->execute();
                echo "Inserted into table successfully";
            } catch (\PDOException $e) {
                throw new \Exception($e);
            }
        }
    }

    /**
     * checks if a table  exists
     * @return boolean
     */
    private function checkTable($tableName)
    {
        $statement = "select * from " . $tableName;
        try {
            $query = $this->pdoConnection->prepare($statement);
            $result = $query->execute();
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }

    /**
     * specifies the database to use
     * @return null
     */
    private function useDataBase()
    {
        try {
            $statement = "USE " . $this->dbName;
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
        }
    }

    /**
     * creates a database 
     * @return null
     */
    private function createDataBase()
    {
        try {
            $statement = "CREATE DATABASE IF NOT EXISTS " . $this->dbName;
            $query = $this->pdoConnection->prepare($statement);
            $query->execute();
        } catch (\PDOException $e) {
        }
    }

    /**
     * gets the project root folder
     * @return filePath
     */
    private function getProjectRoot()
    {
        return dirname(\Composer\Factory::getComposerFile());
    }

    /**
     * checks if .env file exists
     * @return bool
     */
    private function getEnv()
    {
        return file_exists($this->getProjectRoot() . "/.env");
    }

}
