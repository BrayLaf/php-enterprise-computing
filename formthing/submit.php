<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    echo "Submitted Username: " . $username . "<br>";
    echo "Submitted Password: " . $password;
} else {
    echo "No data submitted.";
}
//echo nl2br("\n\n");
//print_r($_SERVER);

echo nl2br("\n\n");
print_r($_POST);
echo nl2br("\n\n");
print_r($_GET);
?>