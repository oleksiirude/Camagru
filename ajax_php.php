<?php
	$data = json_decode(file_get_contents('php://input'));
	$data = (array) $data;
	if (isset($data['login']) && isset($data['password']) && isset($data['confirm'])
		&& !empty($data['login']) && !empty($data['password']) && !empty($data['confirm']))
		echo json_encode(true);
	else
		echo json_encode(false);