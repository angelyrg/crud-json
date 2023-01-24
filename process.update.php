<?php
//Update process level name
require_once('Master.php');
$master = new Master();

$id = $_POST['process_id'];
$title = isset($_POST['edit_level_name']) ? $_POST['edit_level_name'] : null;

if (isset($_POST['btn_save_attach'])) {
    $countfiles = count($_FILES['attach_file']['name']);
    $names = [];
    for ($i = 0; $i < $countfiles; $i++) {
        $filename = $_FILES['attach_file']['name'][$i];
        move_uploaded_file($_FILES['attach_file']['tmp_name'][$i], 'testupload/' . $filename);
        array_push($names, $filename);
    }

    $master->update_json_data($id, $title, $pdf_name, $names);
}

if (isset($_POST['btn_upload_pdf'])) {
    $targetfolder = "testupload/";
    $targetfolder = $targetfolder . basename($_FILES['pdf_file']['name']);
    $pdf_name = null;
    if (move_uploaded_file($_FILES['pdf_file']['tmp_name'], $targetfolder)) {
        echo "The file " . basename($_FILES['pdf_file']['name']) . " is uploaded";
        $pdf_name = basename($_FILES['pdf_file']['name']);
        $master->update_json_data($id, $title, $pdf_name, null);
    } else {
        echo "Problem uploading file";
    }
}



header("Location: ./");
