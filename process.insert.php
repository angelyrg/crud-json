<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['parent_level_id'];
$title = $_POST['new_level_name'];

$master->insert_child_data($id, $title, "bizagiFolder");

header("Location: ./");

?>
