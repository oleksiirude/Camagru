<?php

	abstract class componentDatabase extends PDO {

		//get connection to mySQL via PDO
		//constants in parent construct are located in ~/config/config.php
		function __construct() {
			parent::__construct(DSN, USERNAME, PASSWORD,
				[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			if ($this->useDatabase() === false) {
				$this->createDatabase();
			}
		}

		//check if db already exists
		private function useDatabase () {
			try {
				$this->query("USE ".DBNAME);
				return true;
			} catch (PDOException $ex) {
				return false; }
		}

		//create db with using  TABLES constant (~/config/tables.php)
		private function createDatabase() {
			$this->query("CREATE DATABASE ".DBNAME);
			$this->useDatabase();

			foreach (TABLES as $title => $table) {
				$this->query($table);
			}
		}
	}
