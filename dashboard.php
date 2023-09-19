<?php
include "./config/config.php";
include "./app/manageTodo.php";
ob_start();


echo $_SESSION['name'];
?>







<?php
$pageContent = ob_get_contents();
ob_end_clean();
$pageTitle = 'Dashboard';
include('master.php');
?>