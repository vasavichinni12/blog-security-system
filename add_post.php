<?php
session_start();
include "db.php";

// login check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$message = "";

// when form submit
if(isset($_POST['add_post'])){

    $title = $_POST['title'];
    $description = $_POST['description'];

    $image = "";

    // image upload check
    if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != ""){

        // safe folder check
        if(!is_dir("uploads")){
            mkdir("uploads", 0777, true);
        }

        $image = "uploads/" . basename($_FILES['image']['name']);

        move_uploaded_file($_FILES['image']['tmp_name'], $image);
    }

    // validation
    if($title == "" || $description == ""){
        $message = "All fields required!";
    } else {

        // insert into DB
        $sql = "INSERT INTO posts (title, description, image)
                VALUES ('$title', '$description', '$image')";

        if($conn->query($sql)){
            $message = "Post Added Successfully!";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!-- ================= FORM ================= -->

<h2>Add Blog Post</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="text" name="title" placeholder="Enter Title"><br><br>

    <textarea name="description" placeholder="Enter Description"></textarea><br><br>

    <input type="file" name="image"><br><br>

    <button type="submit" name="add_post">Add Post</button>

</form>

<!-- ================= MESSAGE ================= -->

<p style="color:green;">
<?php echo $message; ?>
</p>

<br>

<a href="index.php">⬅ Back to Home</a>