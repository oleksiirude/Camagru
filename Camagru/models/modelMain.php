<?php
class modelMain extends componentModel {

	private function getFormattedDate($result) {
		$i = 0;
		foreach ($result as $item) {
			$date = date("m-d-y g:i A", strtotime($item['add_date']));
			$result[$i]['add_date'] = $date;
			$i++;
		}
		return $result;
	}

	public function getFivePostsMain($elements) {
		$limit = 5 + (int)$elements;

		$query = "SELECT * FROM posts ORDER BY add_date DESC LIMIT $limit";
		$sth = $this->prepare($query);
		$sth->execute();
		$result = $sth->fetchAll(self::FETCH_ASSOC);

		$full = false;
		if ($result)
			$full = true;

		while ($elements--)
			array_shift($result);

		$i = 0;
		if (!empty($_SESSION['user_id'])) {
			$user = $_SESSION['user_id'];
			foreach ($result as $item) {
				$id = $item['id'];

				$sth = $this->query("SELECT list FROM likes WHERE post = '$id'");
				$list = $sth->fetchAll(self::FETCH_ASSOC);
				if (!empty($list)) {
					$list = $list[0]['list'];
					if (preg_match("/$user/", $list))
						$liked = '1';
					else
						$liked = '0';
				}
				else
					$liked = '0';
				$result[$i]['liked'] = $liked;
				$i++;
			}
		}

		if (!$full && empty($result))
			return ['empty' => true];

		if (!empty($result))
			$result = $this->getFormattedDate($result);

		return $result;
	}
}