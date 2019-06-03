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

		if (!$full && empty($result))
			return ['empty' => true];

		if (!empty($result))
			$result = $this->getFormattedDate($result);

		return $result;
	}
}