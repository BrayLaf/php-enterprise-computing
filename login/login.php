<?php 
    include 'partial/header.php';
    include 'partial/nav.php'; 
    $error = '';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($connection, $sql);

        if(mysqli_num_rows($result) == 1){
            $user = mysqli_fetch_assoc($result);
            if(password_verify($password, $user['password'])){
                $_SESSION['logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                redirect('dashboard.php');
            }else{
                $error = 'Invalid username or password';
            }
        }else{
            $error = 'Invalid username or password';
        }
    }
?>
<main>
    <form method="POST">
        <h1>Login</h1>
        <!-- <label for="username">Username:</label> -->
        <input type="text" name="username" id="username" placeholder="username" required>
        <br><br>
        <!-- <label for="password">Password:</label> -->
        <input type="password" name="password" id="password" placeholder="password" required>
        <br><br>
        <input type="submit" value="Login">
    </form>
    <p style="color:red;"><?php echo $error; ?></p>
</main>
<?php include 'partial/footer.php'; ?>
<?php 
    mysqli_close($connection);
?>