<?php
$conn = new mysqli("localhost", "root", "", "blog-project");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>