<?php

require_once('master.php');
$master = new Master();
$id = $_POST['id'];
$title = $_POST['edit_level_name'];


$data = $master->get_all_data();
$data[$id] = (object) [
    "id" => $id,
    "text" => $title
];
$json = json_encode(array_values($data), JSON_PRETTY_PRINT);
$update = file_put_contents($master->data_file, $json);



header("Location: index.php");

?>
