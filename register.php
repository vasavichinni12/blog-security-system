<?php
include "db.php";

$message = "";

if(isset($_POST['register'])){

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password_raw = $_POST['password'];

    // basic validation (IMPORTANT FIX)
    if($username == "" || $email == "" || $password_raw == ""){
        $message = "All fields required!";
    } else {

        $password = password_hash($password_raw, PASSWORD_DEFAULT);

        // check email exists
        $check = $conn->query("SELECT * FROM users WHERE email='$email'");

        if($check->num_rows > 0){
            $message = "Email already exists!";
        } else {

            $sql = "INSERT INTO users (username, email, password)
                    VALUES ('$username','$email','$password')";

            if($conn->query($sql)){
                $message = "Registered Successfully!";
            } else {
                $message = "Error: " . $conn->error;
            }
        }
    }
}
?>

<h2>Register</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit" name="register">Register</button>
</form>

<p style="color:red;">
<?php echo $message; ?>
</p>