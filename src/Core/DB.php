<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 25.04.2017
 * Time: 10:30
 */
class DB extends ABase {
	protected $host = 'localhost';
	protected $user = '';
	protected $password = '';
	protected $db = '';
	protected $port = 0;
	protected $connection;

	/**
	 * DB constructor.
	 * @param array $data
	 */
	public function __construct( $data = array() ) {
		$this->setData($data);
	}

	/**
	 * @param string $engine
	 */
	public function connect($engine = 'mysql') {
		try {
			$dsn 		= '';
			$dsnSuffix 	= 'dbname=' . $this->getDb() . ';' .
						  'host=' . $this->getHost() .
						  ($this->getPort() > 0 ? ':' . $this->getPort() : '');
			switch($engine) {
				case 'postgres':
					$dsn = 'pgsql:' . $dsnSuffix;
				break;

				case 'oracle':
					$tns =
						'(DESCRIPTION =
							(ADDRESS_LIST =
								(ADDRESS = 
									(PROTOCOL = TCP)(HOST = ' . $this->getHost() .')
									(PORT = ' . $this->getPort() . ')
								)
							)
							(CONNECT_DATA =
								(SERVICE_NAME = orcl)
							)
						)';
					$dsn = 'oci:dbname' . $tns;
				break;

				case 'mssql':
					$dsn = 'dblib:' . $dsnSuffix;
				break;

				default:
					$dsn = 'mysql:' . $dsnSuffix;
				break;
			}

			if ($con = new PDO($dsn, $this->getUser(), $this->getPassword())) {
				$this->setConnection($con);
			} else {
				$this->setConnection(null);
				throw new PDOException('Connection failed');
			}
		} catch (PDOException $e) {
			echo $e;
		}
	}

	/**
	 * @return string
	 */
	public function getHost(): string {
		return $this->host;
	}

	/**
	 * @param string $host
	 * @return DB
	 */
	public function setHost(string $host): DB {
		$this->host = $host;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUser(): string {
		return $this->user;
	}

	/**
	 * @param string $user
	 * @return DB
	 */
	public function setUser(string $user): DB {
		$this->user = $user;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPassword(): string {
		return $this->password;
	}

	/**
	 * @param string $password
	 * @return DB
	 */
	public function setPassword(string $password): DB {
		$this->password = $password;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getDb(): string {
		return $this->db;
	}

	/**
	 * @param string $database
	 * @return DB
	 */
	public function setDb(string $db): DB {
		$this->db = $db;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPort(): int {
		return $this->port;
	}

	/**
	 * @param string $port
	 * @return DB
	 */
	public function setPort(int $port): DB {
		$this->port = $port;
		return $this;
	}

	/**
	 * @return PDO
	 */
	public function getConnection(): PDO {
		return $this->connection;
	}

	/**
	 * @param PDO $connection
	 * @return DB
	 */
	public function setConnection(PDO $connection) {
		$this->connection = $connection;
		return $this;
	}
}