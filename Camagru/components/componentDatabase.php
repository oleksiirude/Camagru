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

		//create and fill db with using TABLES, USERS constants (~/config/data.php)
//		private function createDatabase() {
//			$this->query("CREATE DATABASE ".DBNAME);
//			$this->useDatabase();
//
//			foreach (TABLES as $title => $table)
//				$this->query($table);
//			foreach (USERS as $table => $query)
//				$this->query($query);
//			foreach (POSTS as $table => $query)
//				$this->query($query);
//			foreach (COMMENTS as $table => $query)
//				$this->query($query);
//			foreach (LIKES as $table => $query)
//				$this->query($query);
//		}
	}
