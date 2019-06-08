<?php

class modelAdmin extends componentModel {

	public function reCreateDb()
	{
		$this->query("DROP DATABASE IF EXISTS ".DBNAME);
		$this->query("CREATE DATABASE ".DBNAME);
		$this->query("USE ".DBNAME);
		foreach (TABLES as $title => $table)
			$this->query($table);

		$path = ROOT.'views/pictures/posts';
		$files = glob($path."/*");
		if (count($files) > 0) {
			foreach ($files as $file) {
				if (file_exists($file)) {
					unlink($file);
				}
			}
		}

		$path = ROOT.'views/pictures/avatars';
		$files = glob($path."/*.jpeg");
		if (count($files) > 0) {
			foreach ($files as $file) {
				if (file_exists($file)) {
					unlink($file);
				}
			}
		}
		session_destroy();
        $_SESSION['admin_logged'] = true;
	}
}