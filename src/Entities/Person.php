<?php

/**
 * Created by PhpStorm.
 * User: PaarBreakdowns
 * Date: 20.04.2017
 * Time: 19:23
 */
class Person extends ABase {

	protected $id = 0;
	protected $name = '';
	protected $vorname = '';
	protected $adresse;
	/** @var  PDO */
	protected static $database;

	/**
	 * Person constructor.
	 * @param array $person
	 */
	public function __construct(array $person = []) {
		$this->setData($person);
	}

	/**
	 * @return int
	 */
	public function getId(): int {
		return $this->id;
	}

	/**
	 * @param int $id
	 * @return Person
	 */
	public function setId(int $id): Person {
		$this->id = $id;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getName(): string {
		return $this->name;
	}

	/**
	 * @param string $name
	 * @return Person
	 */
	public function setName(string $name): Person {
		$this->name = $name;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getVorname(): string {
		return $this->vorname;
	}

	/**
	 * @param string $vorname
	 * @return Person
	 */
	public function setVorname(string $vorname): Person {
		$this->vorname = $vorname;
		return $this;
	}

	/**
	 * @return mixed
	 */
	public function getAdresse(): Adresse {
		return $this->adresse;
	}

	/**
	 * @param mixed $adresse
	 * @return Person
	 */
	public function setAdresse($adresse) {
		if ($adresse instanceof Adresse) {
			$this->adresse = $adresse;
		} else {
			$this->adresse = new Adresse(($adresse ?? []));
		}
		return $this;
	}

	/**
	 * @return PDO
	 */
	public static function getDatabase(): PDO {
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
		$sql = 'SELECT * FROM person INNER JOIN adresse ON person.adresse_id = adresse.id';
		$query = self::$database->query($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'Person');
		return $query->fetchAll();
	}

	/**
	 * @param int $id
	 * @return Person
	 */
	public static function find(int $id): Person {
		$sql = 'SELECT * FROM person WHERE id = ?';
		$query = self::$database->prepare($sql);
		$query->setFetchMode(PDO::FETCH_CLASS, 'Person');
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

		print_r(array_values($objArray));
		print_r($valuesFromObjArray);

		$sql =
			'INSERT INTO person (' . array_keys($objArray) .
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
		$sql = 'UPDATE person SET ' . $condition;
		$query = self::$database->prepare($sql);
		$query->execute(array_values($objArray));
	}

	/**
	 *
	 */
	public function delete() {
		$sql = 'DELETE FROM person WHERE id = ?';
		$query = self::$database->prepare($sql);
		if ($query->execute($this->getId())) {
			$this->setId(0);
		}
	}
}