<?php
if (!isset($pageTitle)) {
    $pageTitle = 'Student Manager';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($pageTitle); ?></title>
    <link rel="stylesheet" href="view/assets/style.css">
</head>
<body>
<div class="app-shell">
    <header class="topbar">
        <h1>Student Information Manager</h1>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a class="link-btn danger" href="index.php?action=logout">Logout</a>
        <?php endif; ?>
    </header>
    <main class="content">
