<?php
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $search = $_GET['search'];

    echo "You searched for: " . $search;
} else {
    echo "No data received.";
}
?>