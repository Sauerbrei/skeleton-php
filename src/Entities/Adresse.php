<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 19:19
 */
class Adresse extends ABase {

	protected $id = 0;
	protected $strasse = '';
	protected $hnr = '';
	protected $plz = '';
	protected $ort = '';
	/** @var PDO */
	protected static $database;

	/**
	 * Adresse constructor.
	 * @param array $data
	 */
	public function __construct( array $data = []) {
		$this->setData($data);
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Adresse
	 */
	protected function setId(int $id): Adresse {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getHnr(): string {
		return $this->hnr;
	}

	/**
	 * @param string $hnr
	 * @return Adresse
	 */
	public function setHnr(string $hnr): Adresse {
		$this->hnr = $hnr;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getOrt(): string {
		return $this->ort;
	}

	/**
	 * @param string $ort
	 * @return Adresse
	 */
	public function setOrt(string $ort): Adresse {
		$this->ort = $ort;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getPlz(): string {
		return $this->plz;
	}

	/**
	 * @param string $plz
	 * @return Adresse
	 */
	public function setPlz(string $plz): Adresse {
		$this->plz = $plz;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getStrasse(): string {
		return $this->strasse;
	}

	/**
	 * @param string $strasse
	 * @return Adresse
	 */
	public function setStrasse(string $strasse): Adresse {
		$this->strasse = $strasse;
		return $this;
	}

	/**
	 * @return PDO
	 */
	public function getDatabase(): PDO {
		return self::$database;
	}

	/**
	 * @param PDO $database
	 */
	public static function setDatabase(PDO $database) {
		self::$database = $database;
	}

	/**
	 * @return array
	 */
	public static function findAll(): array {
		$sql = 'SELECT * FROM adresse';
		$query = self::$database->query($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'Adresse');
		return $query->fetchAll();
	}

	/**
	 * @param int $id
	 * @return Adresse
	 */
	public static function find(int $id): Adresse {
		$sql = 'SELECT * FROM adresse WHERE id = ?';
		$query = self::$database->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'Adresse');
		return $query->fetch([$id]);
	}

	/**
	 *
	 */
	public function save() {
		if ($this->getId() > 0) {
			$this->update();
		} else {
			$this->insert();
		}
	}

	/**
	 *
	 */
	protected function insert() {
		$objArray = get_object_vars($this);
		unset($objArray['id']);

		$valuesFromObjArray = array_fill(0, count($objArray), '?');

		$sql =
			'INSERT INTO adresse (' . array_keys($objArray) .
			') VALUES (' . implode($valuesFromObjArray, ', ') . ')';

		$query = self::$database->prepare($sql);
		if ($query->execute(array_values($objArray))) {
			$this->setId(self::$database->lastInsertId());
		}

	}

	/**
	 *
	 */
	protected function update() {
		$objArray = get_object_vars($this);
		$condition = array_map(function($v) {
			return $v . '=?';
		}, array_keys($objArray));
		$sql = 'UPDATE adresse SET ' . $condition;
		$query = self::$database->prepare($sql);
		$query->execute(array_values($objArray));
	}

	/**
	 *
	 */
	public function delete() {
		$sql = 'DELETE FROM adresse WHERE id = ?';
		$query = self::$database->prepare($sql);
		if ($query->execute($this->getId())) {
			$this->setId(0);
		}
	}

}