<?php

namespace  App\Infrastructure\Connection;
use Slim\PDO\Database;

include_once 'DBConfig.php';
include_once 'DBException.php';

class DBConnection
{
    /** @var $this */
    private static $instance;

    /** @var PDO */
    private $pdo;

    /** @var PDOStatement */
    private $pdoStatement;

    /** @var array */
    private $lastParams;

    protected function __construct()
    {
        //
    }

    protected function __clone()
    {
        //
    }

    /**
     * @param string $database
     * @return DBConnection
     * @throws DBException
     * @throws soapfault
     */
    public static function getInstance()
    {
        try {
            if (is_null(self::$instance)) {
                DBConfig::loadConfig();

                self::$instance = new static();
                self::$instance->pdo = new \PDO(
                    'mysql:host=' . DBConfig::$HOST . ';dbname=' . DBConfig::$DATABASE,
                    DBConfig::$USER,
                    DBConfig::$PASSWORD
                );
                self::$instance->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            }

            return self::$instance;
        } catch (\PDOException $e) {
            $mensagem = "Drivers disponiveis: " . implode(",", \PDO::getAvailableDrivers());
            $mensagem .= "\nMenssagem de erro: " . $e->getMessage();

            throw new DBException($mensagem, (int)$e->getCode());
        }
    }

    /**
     * @param string $sql
     * @return $this
     * @throws DBException
     */
    public function prepare($sql)
    {
        try {
            $this->pdoStatement = $this->pdo->prepare($sql);
            return $this;
        } catch (\PDOException $e) {
            $this->pdoStatement = null;
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @param array $params
     * @return $this
     * @throws DBException
     */
    public function bindValues($params = null)
    {
        try {
            if (!is_array($params)) {
                throw new DBException('O parâmetro deste método deve ser um array');
            }

            if (is_null($this->pdoStatement)) {
                throw new DBException(
                    'Nenhum SQL foi preparado. Utilize o método "prepare" antes de utilizar este método'
                );
            }

            $this->lastParams = $params;

            foreach ($params as $key => $value) {
                $this->pdoStatement->bindValue(':' . $key, ($value ? $value : ''));
            }

            return $this;
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return $this
     * @throws DBException
     */
    public function execute()
    {
        try {
            $result = $this->pdoStatement->execute();

            if (!$result) {
                throw new \Exception($this->debugSql());
            }

            return $this;
        } catch (\Exception $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @param int $fetch_style
     * @return mixed
     * @throws DBException
     */
    public function fetch($fetch_style = \PDO::FETCH_ASSOC)
    {
        try {
            return $this->pdoStatement->fetch($fetch_style);
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

     /**
     * @param int $fetch_style
     * @return mixed
     * @throws DBException
     */
    public function fetchAll($fetch_style = \PDO::FETCH_ASSOC)
    {
        try {
            return $this->pdoStatement->fetchAll($fetch_style);
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return string
     * @throws DBException
     */
    public function debugSql()
    {
        if (is_null($this->pdoStatement)) {
            throw new DBException('Nenhum SQL preparado. Utilize o método "prepare" para configurar a SQL');
        }

        $query = $this->pdoStatement->queryString;

        if (!empty($this->lastParams)) {
            foreach ($this->lastParams as $key => $value) {
                $query = preg_replace("'\:{$key}\b'", (is_numeric($value) ? $value : "'" . $value . "'"), $query);
            }
        }

        return $query;
    }

    /**
     * @return $this
     * @throws DBException
     */
    public function beginTransaction()
    {
        try {
            $this->pdo->beginTransaction();
            return self::$instance;
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return $this
     * @throws DBException
     */
    public function commit()
    {
        try {
            $this->pdo->commit();
            return $this;
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return $this
     * @throws DBException
     */
    public function rollBack()
    {
        try {
            $this->pdo->rollBack();
            return $this;
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

    /**
     * @return bool
     * @throws DBException
     */
    public function inTransaction()
    {
        try {
            return $this->pdo->inTransaction();
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }

     /**
     * @return number of affected rows
     * @throws DBException
     */
    public function rowCount()
    {
        try {
            return $this->pdoStatement->rowCount();
        } catch (\PDOException $e) {
            throw new DBException($e->getMessage(), (int)$e->getCode(), $e);
        }
    }
}