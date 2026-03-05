<?php
$pageTitle = 'Login';
include __DIR__ . '/../partials/header.php';
?>

<div class="card auth-card">
    <h2>Login</h2>
    <p class="muted">Use your email and password to access student records.</p>

    <?php if (!empty($message)): ?>
        <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form method="post" action="index.php?action=login" class="form-grid">
        <label>Email</label>
        <input type="email" name="email" placeholder="you@example.com" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="••••••••" required>

        <button type="submit" class="btn primary">Login</button>
    </form>

    <p class="switch-auth">
        Need an account?
        <a href="index.php?action=register">Register here</a>
    </p>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
