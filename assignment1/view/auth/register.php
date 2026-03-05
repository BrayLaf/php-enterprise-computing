<?php
$pageTitle = 'Register';
include __DIR__ . '/../partials/header.php';
?>

<div class="card auth-card">
    <h2>Create Account</h2>
    <p class="muted">Register with username, email and password.</p>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?action=register" class="form-grid">
        <label>Username</label>
        <input type="text" name="username" placeholder="yourusername" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>

        <button type="submit" class="btn primary">Register</button>
    </form>

    <p class="switch-auth">
        Already have an account?
        <a href="index.php?action=login">Back to login</a>
    </p>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
