<?php

require_once('config.php');

if(empty($_FILES['image'])){
	echo json_encode(array('success' => 0, 'files' => $_FILES));
	exit;
}

$ext = '.' . substr(strrchr($_FILES['image']['name'], "."), 1);

// Pick up a free name, upload.php is used because it is known to be present
$uploadfile = 'upload.php';

while(file_exists($uploadfile))
	$uploadfile = substr(sha1(rand(1000, 100000)), 0, rand(5,7));

$response = array();
$response['success'] = move_uploaded_file($_FILES['image']['tmp_name'], BASE_PATH . $uploadfile . $ext);

$response['link'] =  BASE_URL . $uploadfile;

echo json_encode($response);
