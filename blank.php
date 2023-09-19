<?php
ob_start();
?>

<div class="page-header">
    <h4>Manage Todos</h4>
    <div class="page-header-buttons">
        <button class="btn btn-primary">Add Todo</button>
    </div>
</div>

<div class="page-body">

    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>
                    <button class="btn btn-sm btn-success">Edit</button>
                    <button class="btn btn-sm btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>

</div>

<?php
$pageContent = ob_get_contents();
ob_end_clean();
$pageTitle = 'Blank Page';
include('master.php');
?>