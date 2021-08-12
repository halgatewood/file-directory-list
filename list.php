<?php

$data = scandir(htmlspecialchars($_GET['name']));

if ($data) {
	header('Content-type:application/json;charset=utf-8');
	echo json_encode($data);
} else {
	header('Content-type:application/json;charset=utf-8');
	echo json_encode(array());
}

?>