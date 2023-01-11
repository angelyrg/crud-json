<?php
session_start();
require_once('master.php');
$master = new Master();
$json_data = $master->get_all_data();
include("includes/modal_new_level.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JSON</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js" integrity="sha512-naukR7I+Nk6gp7p5TMA4ycgfxaZBJ7MO5iC3Fp6ySQyKFHOGfpkSZkYVWV5R7u7cfAicxanwYQ5D1e17EfJcMA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success bg-gradient">
        <div class="container">
            <a class="navbar-brand" href="#">Navbar</a>
        </div>
    </nav>
    <div class="container px-5 my-3">
        <h2 class="text-center my-4">All process</h2>
        <div class="row">
            <!-- Page Content Container -->
            <div class="col-md-4">
                <div class="row text-end">
                    <spam>
                        <button type="button" class="btn btn-sm btn-outline-dark rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_new_level">
                            <i class="fa-solid fa-plus"></i> New level
                        </button>
                    </spam>
                </div>

                <ul class="list-group">
                    <?php foreach ($json_data as $data) { ?>
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between align-items-center">
                                <?= $data->text; ?>
                                <span class="badge" data-bs-toggle="tooltip" data-bs-placement="right" title="Add new level">
                                    <button type="button" class="btn btn-sm btn-outline-warning rounded-pill" data-bs-toggle="modal" data-bs-target="#modal_edit_level_<?= $data->id; ?>" >
                                        <i class="fa-regular fa-pen-to-square"></i>
                                    </button>
                                </span>
                                <?php include("includes/modal_edit_level.php"); ?>
                            </div>
                            <?php
                            if (isset($data->items)) { ?>
                                <ul class="list-group">
                                    <?php foreach ($data->items as $item) { ?>

                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= $item->text; ?>
                                            <span class="badge bg-primary rounded-pill">14</span>
                                        </li>

                                    <?php } ?>
                                </ul>
                            <?php } ?>
                        </li>
                    <?php } ?>
                </ul>

            </div>
            <!-- Table -->
            <div class="col-md-8 mx-auto">
                <div class="container-fluid">
                    <!-- Handling Messages Form Session -->
                    <?php if (isset($_SESSION['msg_success']) || isset($_SESSION['msg_error'])) : ?>
                        <?php if (isset($_SESSION['msg_success'])) : ?>
                            <div class="alert alert-success rounded-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['msg_success'] ?></div>
                                    <div class="col-auto">
                                        <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['msg_success']); ?>
                        <?php endif; ?>
                        <?php if (isset($_SESSION['msg_error'])) : ?>
                            <div class="alert alert-danger rounded-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="col-auto flex-shrink-1 flex-grow-1"><?= $_SESSION['msg_error'] ?></div>
                                    <div class="col-auto">
                                        <a href="#" onclick="$(this).closest('.alert').remove()" class="text-decoration-none text-reset fw-bolder mx-3">
                                            <i class="fa-solid fa-times"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <?php unset($_SESSION['msg_error']); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                    <!--END of Handling Messages Form Session -->
                    <div class="card rounded-0 shadow">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div class="card-title col-auto flex-shrink-1 flex-grow-1">Process List</div>
                                <div class="col-atuo">
                                    <a class="btn btn-danger btn-flat" href="member_form.php"><i class="fa fa-plus-square"></i> Create new level</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="container-fluid table-responsive">
                                <table class="table table-stripped table-bordered">
                                    <colgroup>
                                        <col width="5%">
                                        <col width="20%">
                                        <col width="20%">
                                        <col width="35%">
                                        <col width="20%">
                                    </colgroup>
                                    <thead>
                                        <tr>
                                            <th class="text-center">ID</th>
                                            <th class="text-center">Title</th>
                                            <th class="text-center">Bizagi Folder</th>
                                            <th class="text-center">Items</th>
                                            <th class="text-center">Acción</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($json_data as $data) : ?>
                                            <tr>
                                                <td class="text-center"><?= $data->id ?></td>
                                                <td><?= $data->text ?></td>
                                                <td><?= isset($data->bizagi_folder) ? $data->bizagi_folder : "No folder" ?></td>
                                                <td><?= isset($data->items) ? count($data->items) : "No items" ?></td>
                                                <td class="text-center">
                                                    <a href="member_form.php?id=<?= $data->id ?>" class="btn btn-sm btn-outline-info rounded-0">
                                                        <i class="fa-solid fa-edit"></i>
                                                    </a>
                                                    <a href="delete_data.php?id=<?= $data->id ?>" class="btn btn-sm btn-outline-danger rounded-0" onclick="if(confirm(`¿Deseas eliminar del registro a <?= $data->name ?>?`) === false) event.preventDefault();">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="assets/app.js"></script>
    <script>
        //Enable tooltips
        // var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        //     return new bootstrap.Tooltip(tooltipTriggerEl)
        // })
    </script>
</body>

</html>