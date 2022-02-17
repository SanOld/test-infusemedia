<?php

/**
 * Description of Database
 *
 */
final class Database
{

    private $driver;
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $connection = null;
    private $statement = null;

    /**
     *
     * @param string $driver
     * @param string $host
     * @param string $dbname
     * @param string $username
     * @param string $password
     */
    public function __construct(string $driver, string $host, string $dbname, string $username, string $password)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        
        $this->connect();
    }

    /**
     * Connect to the database.
     *
     * @return void
     * @throws \Exception
     */
    private function connect():void
    {
        $this->connection = null;

        try {
            $this->connection = new \PDO(
                $this->driver . ":host=" . $this->host . ";dbname=" . $this->dbname,
                $this->username,
                $this->password,
                [PDO::ATTR_PERSISTENT => true]
            );
            $this->connection->exec("SET NAMES 'utf8mb4'");
            $this->connection->exec("SET CHARACTER SET utf8mb4");
            $this->connection->exec("SET CHARACTER_SET_CONNECTION=utf8mb4");
        } catch (\PDOException $e) {
            throw new \Exception('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode());
        }
    }

    /**
     * Disconnect from the database.
     *
     * @return void
     */
    public function disconnect(): void
	{
		$this->connection = null;
        $this->statement = null;
	}

	/**
	 * Reconnect to the database.
	 *
	 * @return void
	 *
	 * @throws \LogicException
	 */
	public function reconnect(): void
	{
		try {
            $this->connect();
        } catch (Exception $ex) {
            throw new \LogicException("Lost connection and no the reconnection available.");
        }
	}

    /**
     *
     * @param type $sql
     * @return \PDOStatement
     */
    private function prepare($sql): \PDOStatement
    {
        return $this->statement = $this->connection->prepare($sql);
    }

    /**
     *
     * @return bool
     * @throws \Exception
     */
    private function execute(): bool
    {
        try {
            return $this->statement->execute();
        } catch (\PDOException $e) {
            throw new \Exception('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode());
        }
    }

    /**
     *
     * @param string $sql
     * @param array $params
     * @return mixed
     * @throws \Exception
     */
    public function query(string $sql, array $params = [])
    {

        try {

            $this->statement = $this->connection->prepare($sql);

            if ($this->statement) {
                return $this->statement->execute($params);
            }
        } catch (\PDOException $e) {
            throw new \Exception('Error: ' . $e->getMessage() . ' Error Code : ' . $e->getCode() . ' <br />' . $sql);
        }

        return false;
    }

}