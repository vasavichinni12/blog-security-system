<?php
session_start();
include "db.php";

// login check
if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

// fetch posts
$result = $conn->query("SELECT * FROM posts ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Blog Home</title>
</head>
<body>

<h2>Welcome <?php echo $_SESSION['username']; ?> 👋</h2>

<a href="add_post.php">➕ Add Post</a> |
<a href="logout.php">🚪 Logout</a>

<hr>

<h3>All Blog Posts</h3>

<?php
if($result && $result->num_rows > 0){
    while($row = $result->fetch_assoc()){
?>

    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">

        <h3><?php echo $row['title']; ?></h3>

        <p><?php echo $row['description']; ?></p>

        <?php if($row['image'] != "") { ?>
            <img src="<?php echo $row['image']; ?>" width="200">
        <?php } ?>
        <a href="delete_post.php?id=<?php echo $row['id']; ?>" 
   onclick="return confirm('Are you sure ?')">
   🗑 Delete
</a>

        <small><?php echo $row['created_at']; ?></small>

    </div>

<?php
    }
} else {
    echo "No posts found!";
}
?>

</body>
</html>