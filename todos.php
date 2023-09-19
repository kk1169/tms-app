<?php
include "./config/config.php";
include "./app/manageTodo.php";
ob_start();
?>

<div class="page-header">
    <h4>Manage Todos</h4>
    <div class="page-header-buttons">
        <a href="<?= $base_url ?>create-todo.php" class="btn btn-primary">Add Todo</a>
    </div>
</div>

<?php if (isset($_GET['success']) && isset($_GET['message'])) { ?>
    <?php if ($_GET['success'] == 'true') { ?>
        <div class="alert alert-success" role="alert">
            <strong>Success!</strong> <?= $_GET['message'] ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            <strong>Error!</strong> <?= $_GET['message'] ?>
        </div>
    <?php } ?>
<?php } ?>

<div class="page-body">

    <div class="row mb-3">
        <div class="col-lg-3">
            <form action="">
                <select class="form-select" name="status" id="status">
                    <option value="">Select Status</option>
                    <?php foreach ($status as $key => $value) { ?>
                        <option value="<?= $key ?>" <?php if ($status_data == $key) {
                                                        echo 'selected';
                                                    } ?>><?= $value ?></option>
                    <?php } ?>
                </select>
                <button type="submit" class="btn btn-success">Search</button>
            </form>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Assigned To</th>
                <th scope="col">Created By</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($todoGetRow > 0) {
                while ($row = $todoGetResult->fetch_assoc()) {
            ?>
                    <tr>
                        <th scope="row"><?= $row['id'] ?></th>
                        <td><?= $row['title'] ?></td>
                        <td><?= $row['assigned_to'] ?></td>
                        <td><?= $row['created_by'] ?></td>
                        <td><?= $status[$row['status']] ?></td>
                        <td>
                            <a href="./edit-todo.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-success">Edit</a>
                            <a onclick="return confirm('Are you sure?')" href="./todos.php?id=<?= $row['id'] ?>&action=delete" class="btn btn-sm btn-danger">Delete</a>
                        </td>
                    </tr>
            <?php
                }
            } else {
                echo "<tr><td colspan='4'>No Data Found</td></tr>";
            } ?>
        </tbody>
    </table>

</div>

<?php
$pageContent = ob_get_contents();
ob_end_clean();
$pageTitle = 'Manage Todos';
include('master.php');
?>