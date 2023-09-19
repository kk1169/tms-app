<?php
include "./config/config.php";
include "./app/manageTodo.php";
ob_start();

?>

<div class="page-header">
    <h4>Edit Todo</h4>
    <div class="page-header-buttons">
        <a href="<?= $base_url ?>todos.php" class="btn btn-primary">Back</a>
    </div>
</div>

<div class="page-body">

    <div class="card">
        <div class="card-body">

            <div class="row">
                <div class="col-lg-6">
                    <!-- form -->
                    <form action="" method="POST">
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" name="title" id="title" value="<?= $todo['title'] ?>" class="form-control" placeholder="Title" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Assigned To</label>
                            <select class="form-select" name="assigned_id" id="assigned_id">
                                <?php while ($u = $getAllUsers->fetch_assoc()) { ?>
                                    <option value="<?= $u['id'] ?>" <?php if ($u['id'] == $todo['assigned_id']) {
                                                                        echo 'selected';
                                                                    } ?>><?= $u['name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control" placeholder="Description"><?= $todo['description'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                <?php foreach ($status as $key => $value) { ?>
                                    <option value="<?= $key ?>" <?php if ($todo['status'] == $key) {
                                                                    echo 'selected';
                                                                } ?>><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success" name="edit_todo">Save Changes</button>
                    </form>
                </div>
            </div>

        </div>
    </div>

</div>

<?php
$pageContent = ob_get_contents();
ob_end_clean();
$pageTitle = 'Edit Todo';
include('master.php');
?>