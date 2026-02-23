<?php   
    $connection = mysqli_connect('Localhost', 'root', '', 'logintest') or die("Could not connect to database" . mysqli_connect_error());

    if($connection){
        echo "<script> console.log('connected') </script>";
    }
?>