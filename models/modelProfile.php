<?php
    class modelProfile extends componentModel {

    	private function getFormattedDate($result) {
			$i = 0;
			foreach ($result as $item) {
				$date = date("m-d-y g:i A", strtotime($item['add_date']));
				$result[$i]['add_date'] = $date;
				$i++;
			}
			return $result;
		}

        public function getFivePostsProfile($elements) {
			$user = $_SESSION['user_logged'];
			$limit = 5 + (int)$elements;

			$query = "SELECT * FROM posts WHERE user = '$user' ORDER BY add_date DESC LIMIT $limit";
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

			if (!empty($result))
				$result = $this->getFormattedDate($result);

			return $result;
        }

        public function getNextPostProfile($postid) {
			$user = $_SESSION['user_logged'];

			$sth = $this->query("SELECT * FROM posts WHERE user = '$user' AND id < '$postid' ORDER BY add_date DESC LIMIT 1");
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
			//______________________________________
			//add deleting comments and likes soon!
			//______________________________________
		}

		public function getComments($id) {
			$sth = $this->query("SELECT author_avatar, author_login, 
							add_date, comment FROM comments WHERE post = '$id'");
			$result = $sth->fetchAll(self::FETCH_ASSOC);

			if (!empty($result))
				$result = $this->getFormattedDate($result);

			return $result;
		}

		public function addComment($post, $comment) {
			$author_id = $_SESSION['user_id'];
			$author_login = $_SESSION['user_logged'];
			if ($_SESSION['avatar'] === false)
				$author_avatar = 'views/pictures/avatars/default.png';
			else
				$author_avatar = $_SESSION['avatar'];
			date_default_timezone_set('Europe/Kiev');
			$date = date("Y-m-d H:i:s");

			//add comment
			$sth = $this->prepare("INSERT INTO comments(post, author_id, author_login, author_avatar, add_date, comment)
                 VALUES ('$post', '$author_id', '$author_login', '$author_avatar','$date', :comment)");
			$sth->execute([':comment' => $comment]);

			//iterate comments counter and get value after
			$this->query("UPDATE posts SET comments = comments+1 WHERE id = '$post'");
			$sth = $this->query("SELECT comments FROM posts WHERE id = '$post'");
			$counter = $sth->fetchAll(self::FETCH_ASSOC);
			$counter = $counter[0]['comments'];

			//grab current comment
			$sth = $this->prepare("SELECT author_avatar, author_login, 
							add_date, comment FROM comments WHERE comment = :comment AND add_date = '$date'");
			$sth->execute([':comment' => $comment]);
			$result = $sth->fetchAll(self::FETCH_ASSOC);

			if (!empty($result))
				$result = $this->getFormattedDate($result);

			$result[0]['counter'] = $counter;
			return $result;
		}
    }
