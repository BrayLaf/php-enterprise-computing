<?php 
    include 'partial/header.php';
    include 'partial/nav.php'; 
    
    $error = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];


        if($password != $confirm_password){
            $error = 'Passwords do not match';
        }else{
            if(checkIfUnique($connection, $username)){
                $error = 'Username already taken';
            }else{
                $hashedPass = password_hash($password, PASSWORD_BCRYPT);

                $sql = "INSERT INTO users (username, email, password) VALUES('$username', '$email', '$hashedPass')";

                if(mysqli_query($connection, $sql)){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = mysqli_insert_id($connection);
                    $_SESSION['username'] = $username;
                    redirect('dashboard.php');
                }else{
                    $error = 'Registration failed. Please try again.';
                }
            }
        }
    }
?>
<main>
     <form method="POST">
        <h1>Register</h1>
        <input type="text" name="username" id="username" placeholder="username" required>
        <br><br>
        <input type="email" name="email" id="email" placeholder="email" required>
        <br><br>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br><br>
        <input type="password" name="confirm_password" id="confirm_password" placeholder="confirm password" required>
        <br><br>
        <input type="submit" value="Register">
    </form>
    <p style="color:red;"><?php echo $error; ?></p>
</main>
<?php include 'partial/footer.php'; ?>
