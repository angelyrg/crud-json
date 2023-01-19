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
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
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

                <!-- Accordion -->
                <div class="accordion" id="acco_sample">
                    <?php
                    foreach ($json_data as $data) {
                        $id_item = $data->id;
                        $title = $data->text;
                    ?>
                        <div class="accordion-item shadow rounded border border-info" draggable="true">
                            <h2 class="accordion-header" id="<?= $id_item ?>">

                                <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                        <?= $title ?>
                                    </button>

                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Options</span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                <i class="fa-solid fa-folder-plus" aria-hidden="true"></i> New level
                                            </button>
                                        </li>
                                        <li>
                                            <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                            </button>
                                        </li>

                                        <li>
                                            <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </h2>
                            <?php
                            include("includes/modal_edit_level.php");
                            include("includes/modal_insert_level.php");
                            ?>
                            <div id="id_<?= $id_item ?>" class="accordion-collapse collapse" aria-labelledby="<?= $id_item ?>">
                                <div class="accordion-body pe-0">
                                    <?php if (isset($data->items)) {
                                        foreach ($data->items as $item) {
                                            $id_item = $item->id;
                                            $title = $item->text;
                                    ?>
                                            <!-- Level 2 -->
                                            <div class="accordion-item shadow rounded border border-info">
                                                <h2 class="accordion-header" id="<?= $id_item ?>">
                                                    <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">
                                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                                            <?= $title ?>
                                                        </button>

                                                        <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <span class="visually-hidden">Options</span>
                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li>
                                                                <button type="button" class="dropdown-item text-info" data-bs-toggle="modal" data-bs-target="#modal_insert_level_<?= $id_item; ?>" title="Add new level into level">
                                                                    <i class="fa-solid fa-folder-plus" aria-hidden="true"></i> New level
                                                                </button>
                                                            </li>
                                                            <li>
                                                                <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                    <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                                                </button>
                                                            </li>

                                                            <li>
                                                                <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                    <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </h2>
                                                <?php
                                                include("includes/modal_edit_level.php");
                                                include("includes/modal_insert_level.php");
                                                ?>
                                                <div id="id_<?= $id_item ?>" class="accordion-collapse collapse" aria-labelledby="<?= $id_item ?>">
                                                    <div class="accordion-body pe-0">
                                                        <?php
                                                        if (isset($item->items)) { ?>
                                                            <ul class="list-group">
                                                                <?php
                                                                foreach ($item->items as $item3) {
                                                                    $id_item = $item3->id;
                                                                    $title = $item3->text;
                                                                ?>
                                                                    <!-- Level 3 -->
                                                                    <h2 class="accordion-body" id="<?= $id_item ?>">
                                                                        <div class="btn-group col-12" role="group" aria-label="Button group with nested dropdown">

                                                                            <button class="accordion-button collapsed item_clickeable" type="button" data-bs-toggle="collapse" data-bs-target="#id_<?= $id_item ?>" aria-expanded="false" aria-controls="id_<?= $id_item ?>">
                                                                                <?= $title ?>
                                                                            </button>

                                                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle dropdown-toggle-split rounded-0" data-bs-toggle="dropdown" aria-expanded="false">
                                                                                <span class="visually-hidden">Options</span>
                                                                            </button>
                                                                            <ul class="dropdown-menu">
                                                                                <li>
                                                                                    <button type="button" class="dropdown-item text-warning" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $id_item; ?>" title="Edit level">
                                                                                        <i class="fa-regular fa-pen-to-square" aria-hidden="true"></i> Edit level name
                                                                                    </button>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="process.destroy.php?id=<?= $id_item ?>" class="dropdown-item text-danger" onclick="if(confirm(`¿Deseas eliminar del registro?`) === false) event.preventDefault();">
                                                                                        <i class="fa-solid fa-trash" aria-hidden="true"></i> Delete level
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    </h2>
                                                            <?php
                                                                }
                                                            } ?>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    } ?>
                                </div>
                            </div>
                        </div><?php
                            } ?>
                </div>



            </div>
            <!-- Details -->
            <div class="col-md-7 mx-auto">
                <div class="container-fluid">
                    <nav class="nav nav-tabs d-flex justify-content-center" id="nav-tab-details" role="tablist">
                        <a class="nav-link btn active text-center" id="nav-pdf-tab" data-bs-toggle="tab" href="#nav-pdf" role="tab" aria-controls="nav-pdf" aria-selected="true">PDF</a>
                        <a class="nav-link btn text-center" id="nav-attach-tab" data-bs-toggle="tab" href="#nav-attach" role="tab" aria-controls="nav-attach" aria-selected="false">ATTACHMENT FILES</a>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="row border-bottom border-3">
                            <label for="">Process name: <b><span id="process_title"></span></b></label>

                        </div>
                        <div class="tab-pane fade show active" id="nav-pdf" role="tabpanel" aria-labelledby="nav-pdf-tab">
                            <h6 class="display">PDF Loading...</h6>
                            <iframe src="" frameborder="0"></iframe>
                        </div>
                        <div class="tab-pane fade" id="nav-attach" role="tabpanel" aria-labelledby="nav-attach-tab">
                            <div class="list-group">
                                <div class="row d-flex justify-content-between">
                                    <p for="">Attachment files</p>
                                    <a class="btn btn-sm btn-outline-dark">
                                        <i class="fa-solid fa-plus" aria-hidden="true"></i> Attach files
                                    </a>
                                </div>
                                <div class="list-item">
                                    Atachment file 1
                                </div>
                                <div class="list-item">
                                    Atachment file 2
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