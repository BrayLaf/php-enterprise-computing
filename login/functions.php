<?php

function isLoggedIn(){
    return isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
}

function setActiveClass($pageName) {
    $currentFile = basename($_SERVER['PHP_SELF']);
    if ($currentFile === $pageName) {
        return 'active';
    }
    return '';
}

function checkIfUnique($connection, $username){
    $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
    $result = mysqli_query($connection, $sql);

    return mysqli_num_rows($result) > 0 ;
}

function redirect($location){
    header('Location: '. $location);
    exit();
}
?>