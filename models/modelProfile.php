<?php
    class modelProfile extends componentModel {

        public function getFivePosts($elements) {
			$id = $_SESSION['user_id'];
			$limit = 5 + (int)$elements;

			$query = "SELECT * FROM posts WHERE user = '$id' ORDER BY add_date DESC LIMIT $limit";
			$sth = $this->prepare($query);
			$sth->execute();
			$result = $sth->fetchAll(self::FETCH_ASSOC);

			$full = false;
			if ($result)
				$full = true;

			while ($elements--)
				array_shift($result);

			if (!$full && empty($result))
				return ['empty' => true];
			return $result;
        }
    }
