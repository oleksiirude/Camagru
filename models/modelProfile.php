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

			$i = 0;
			foreach ($result as $item) {
				$date = date("m-d-y g:i A", strtotime($item['add_date']));
				$result[$i]['add_date'] = $date;
				$i++;
			}

			return $result;
        }

        public function getNextPost($postid) {
			$id = $_SESSION['user_id'];

			$sth = $this->query("SELECT * FROM posts WHERE user = '$id' AND id < '$postid' ORDER BY add_date DESC LIMIT 1");
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			if (!empty($result))
				$result[0]['add_date'] = date("m-d-y g:i A", strtotime($result[0]['add_date']));
			return $result;
		}

        public function deletePost($id) {
        	//delete photo on server
			$sth = $this->query("SELECT path FROM posts WHERE id = '$id'");
			$result = $sth->fetchAll(self::FETCH_ASSOC);
			unlink($result[0]['path']);

			//delete all data connected to this post
			$this->query("DELETE FROM posts WHERE id = '$id'");
			//add deleting comments and likes soon!
		}


    }
