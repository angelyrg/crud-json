<?php
//Update process level name  >>[NEED IMPROVE:when updated, no delete all of data]
require_once('Master.php');
$master = new Master();

$id = $_POST['id'];
$title = $_POST['edit_level_name'];

$master->update_json_data($id, $title);

header("Location: ./");

?>
