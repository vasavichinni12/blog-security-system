<?php
include "db.php";
session_start();

// login check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

    $id = $_GET['id'];

    // delete query
    $sql = "DELETE FROM posts WHERE id=$id";

    if($conn->query($sql)){
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?>