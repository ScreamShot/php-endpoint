<?php

require_once('config.php');

if (empty($_FILES['image'])) {
	echo json_encode(array(
			'success' => 0,
			'files' => $_FILES
		));
	exit;
}

$ext = '.' . substr(strrchr($_FILES['image']['name'], "."), 1);

// Pick up a free name, upload.php is used because it is known to be present
$uploadfile = '';

function generate_hash($size) {
	$alphabet = 'bcdfghjklmnpqrstvwxzBCDFGHJKLMNPQRSTVWXYZ123456789';
	$s        = '';
	for ($i = 0; $i < $size; $i++) {
		$s .= $alphabet[mt_rand(0, strlen($alphabet) - 1)];
	}

	return $s;
}


while (!empty(glob(BASE_PATH . $uploadfile . '.*')) || empty($uploadfile))
	$uploadfile = generate_hash(rand(5, 10));

$response = array();
$response['success'] = move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . $uploadfile . $ext);

$response['link'] = BASE_URL . $uploadfile;

echo json_encode($response);