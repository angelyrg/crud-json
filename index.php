<?php
session_start();
//Get all data
require("process.index.php");

//Include modals
include("includes/modal_new_level.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/512/4236/4236512.png" type="image/vnd.microsoft.icon">
    <title>Process template</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="#">Processes sample</a>
        </div>
    </nav>
    <div class="container px-5 my-3">
        <h2 class="text-center my-4">Admin sample</h2>
        <div class="row">
            <!-- Page Content Container -->
            <div class="col-md-5">
                <div class="row text-end">
                    <spam>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_level">
                            <i class="fa-solid fa-plus" aria-hidden="true"></i> New level
                        </button>
                    </spam>
                </div>

                <ul class="list-group">
                    <?php
                    foreach ($json_data as $data) {
                        $id_item = $data->id;
                        $title = $data->text;
                    ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <!-- Level 1 -->
                                <?= str_replace("_", ".", $id_item) . ". " . $title; ?>
                                <span class="badge">
                                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                        <i class="fa-solid fa-folder-plus" aria-hidden="true"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                        <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                    </button>
                                    <a href="process.destroy.php?id=<?= $id_item ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                    </a>
                                </span>
                                <?php
                                include("includes/modal_edit_level.php");
                                include("includes/modal_insert_level.php");
                                ?>
                            </div>
                            <?php
                            if (isset($data->items)) { ?>
                                <ul class="list-group">
                                    <?php
                                    foreach ($data->items as $item) {
                                        $id_item = $item->id;
                                        $title = $item->text;
                                    ?>
                                        <!-- Level 2 -->
                                        <li class="list-group-item">
                                            <div class=" d-flex justify-content-between align-items-center">
                                                <?= str_replace("_", ".", $id_item) . " " . $title; ?>

                                                <span class="badge rounded-pill">
                                                    <!-- Working on it -->
                                                    <button type="button" class="btn btn-sm btn-outline-info rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                        <i class="fa-solid fa-folder-plus" aria-hidden="true"></i>
                                                    </button>
                                                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                        <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                                    </button>
                                                    <a href="process.destroy.php?id=<?= $id_item ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                        <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                                    </a>
                                                </span>
                                                <?php
                                                include("includes/modal_edit_level.php");
                                                include("includes/modal_insert_level.php");
                                                ?>

                                            </div>

                                            <?php

                                            if (isset($item->items)) { ?>
                                                <ul class="list-group">
                                                    <?php
                                                    foreach ($item->items as $item3) {
                                                        $id_item = $item3->id;
                                                        $title = $item3->text;
                                                        ?>
                                                        <!-- Level 3 -->
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                                            <a href="#" style="text-decoration: none" class="item_clickeable" id="<?= $id_item?>">
                                                                <?= str_replace("_", ".", $id_item) . " " . $title; ?>
                                                            </a>

                                                            <span class="badge rounded-pill">
                                                                <button type="button" class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i>
                                                                </button>
                                                                <a href="process.destroy.php?id=<?= $id_item ?>" class="btn btn-sm btn-outline-danger rounded-pill" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                    <i class="fa-solid fa-trash" aria-hidden="true"></i>
                                                                </a>
                                                            </span>
                                                            <?php
                                                            include("includes/modal_edit_level.php");
                                                            ?>
                                                        </li>

                                                    <?php } ?>
                                                </ul>
                                            <?php } ?>

                                        </li>

                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>

            </div>
            <!-- Table -->
            <div class="col-md-7 mx-auto">
                <div class="container-fluid">
                    <div class="card rounded-0 shadow">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title col-auto flex-shrink-1 flex-grow-1">
                                    Information about process
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid">
                                <div class="row border-bottom border-3">
                                    <label for="">Process name: <b><span id="process_title">...</span></b></label>                                    
                                </div>
                                <div class="row">
                                    <div class="d-flex justify-content-end mt-2 mb-0">
                                        <button class="btn btn-sm btn-outline-dark">
                                            <i class="fa-solid fa-plus" aria-hidden="true"></i> Attach files
                                        </button>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered caption-top">
                                            <caption>Attachment files</caption>
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Option</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Name of attachment file</td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>