<?php

	abstract class componentDatabase extends PDO {

		//get connection to mySQL via PDO
		//constants in parent construct located in ~/config/config.php
		function __construct() {
			try {
				parent::__construct(DSN, USERNAME, PASSWORD,
					[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
			} catch (PDOException $ex) {
				echo "<pre>";
				var_dump($ex->getMessage());
				var_dump($_SERVER);
				exit;
				componentView::errorHandle(503);
			}
			$this->useDatabase();
		}

		//check if db already exists
		private function useDatabase () {
			try {
				$this->query("USE ".DBNAME);
				return true;
			} catch (PDOException $ex) {
				return false;
			}
		}
	}
