<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// include $_SERVER['DOCUMENT_ROOT'] . "/tms-app/config/db.php";
$base_url = "http://localhost/tms-app/";


$status = array("Open", "In Progress", "Test", "Done");

$roles = array("ADMIN", "USER");
