<?php
    class modelProfile extends componentModel {

        public function getFivePosts() {
			$id = $_SESSION['user_id'];

			$query = "SELECT * FROM posts WHERE user = '$id' ORDER BY add_date DESC LIMIT 5";
			$sth = $this->prepare($query);
			$sth->execute();
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			return $result;
        }
    }
