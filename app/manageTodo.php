<?php
include "./config/db.php";

$message = "";


// Get all users
$getAllUsers = $conn->query("SELECT `id`,`name` FROM users WHERE status='Active'");


if (isset($_POST['create_todo'])) {

    // Insert
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);
    $assigned_id = $conn->real_escape_string($_POST['assigned_id']);
    $loggedId = $_SESSION['userId'];

    $todoSaveResult = $conn->query("INSERT INTO `todos`(`title`,`description`,`user_id`,`assigned_id`,`status`) VALUES('$title','$description',$loggedId,$assigned_id,'$status')");

    if ($todoSaveResult) {
        $message = "Todo created successfully";
        header('Location:' . './todos.php?success=true&message=' . $message);
    } else {
        $message = "Something went wrong.";
        header('Location:' . './todos.php?success=false&message=' . $message);
    }
} else if (isset($_POST['edit_todo'])) {

    // Edit
    $todo_id = $_GET['id'];
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $status = $conn->real_escape_string($_POST['status']);
    $assigned_id = $conn->real_escape_string($_POST['assigned_id']);

    $todoSaveResult = $conn->query("UPDATE `todos` SET `title`='$title', `description`='$description', `assigned_id`='$assigned_id', `status`='$status' WHERE id=$todo_id");
    if ($todoSaveResult) {
        $message = "Todo updated successfully";
        header('Location:' . './todos.php?success=true&message=' . $message);
    } else {
        $message = "Something went wrong.";
        header('Location:' . './todos.php?success=false&message=' . $message);
    }
} else if (isset($_GET['id']) && isset($_GET['action'])) {
    // Delete
    if ($_GET['action'] == 'delete') {
        $todoGetResult = $conn->query("DELETE FROM todos WHERE id=" . $_GET['id']);
        if ($todoGetResult) {
            $message = "Todo deleted successfully";
            header('Location:' . './todos.php?success=true&message=' . $message);
        }
    }
} else if (isset($_GET['id'])) {

    // Get All Todos
    $todoGetResult = $conn->query("SELECT * FROM todos WHERE id=" . $_GET['id']);
    $todoGetRow = $todoGetResult->num_rows;
    $todo = $todoGetResult->fetch_assoc();
    if ($todoGetRow == 0) {
        $message = "Something went wrong.";
        header('Location:' . './todos.php?success=false&message=' . $message);
    }
} else {
    $search_status = "";
    $status_data = "";

    // Get All Todos
    if ($_SESSION['role'] === $roles[0]) {

        if (isset($_GET['status']) && $_GET['status'] != "") {
            $status_data = $_GET['status'];
            $search_status = " WHERE t.status='$status_data'";
        }

        // Admin
        $todoGetResult = $conn->query("SELECT t.*, u.name as created_by, au.name as assigned_to FROM todos as t LEFT JOIN users as u ON t.user_id=u.id LEFT JOIN users as au ON t.assigned_id=au.id" . $search_status);
        $todoGetRow = $todoGetResult->num_rows;
    } else {
        $userId = $_SESSION['userId'];

        if (isset($_GET['status']) && $_GET['status'] != "") {
            $status_data = $_GET['status'];
            $search_status = " AND t.status='$status_data'";
        }

        // User
        $todoGetResult = $conn->query("SELECT t.*, u.name as created_by, au.name as assigned_to FROM todos as t LEFT JOIN users as u ON t.user_id=u.id LEFT JOIN users as au ON t.assigned_id=au.id WHERE (t.user_id=$userId OR t.assigned_id=$userId)" . $search_status);
        $todoGetRow = $todoGetResult->num_rows;
    }
}
