<?php

require_once('master.php');
$master = new Master();
$data = $master->get_all_data();

$title = $_POST['level_name'];

$master->insert_to_json($title, "bizagi_folder_name");
$json = json_encode(array_values($data), JSON_PRETTY_PRINT);

$insert = file_put_contents( json_encode($data), $json );


header("Location: index.php");

?>
