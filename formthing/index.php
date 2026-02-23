<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Document</title>
</head>
<body>
    <h1>Form</h1>
    <form action="submit.php" method="POST">
        <label for "username">Username:</label>
        <input type="text" name="username" id="username" placeholder="username" required>
        <br><br>
        <label for "password">Password:</label>
        <input type="password" name="password" id="password" placeholder="password" required>
        <br><br>
        <input type="submit" value="Submit">
    </form>


    <h2>Search</h2>
    <form action="search.php" method="GET">
        <input type="text" name="search" id="search" placeholder="Search...">
        <button type="submit">Search</button>
    </form>
</body>
</html>