<?php
$pageTitle = 'Dashboard';
include __DIR__ . '/../partials/header.php';
?>

<div class="dashboard-grid">
    <section class="card">
        <h2>Add New Student</h2>
        <p class="muted">Create a student record using name, email and student ID.</p>

        <?php if (!empty($flashMessage)): ?>
            <div class="alert success"><?php echo htmlspecialchars($flashMessage); ?></div>
        <?php endif; ?>

        <?php if (!empty($flashError)): ?>
            <div class="alert error"><?php echo htmlspecialchars($flashError); ?></div>
        <?php endif; ?>

        <form method="post" action="index.php?action=create-student" class="form-grid">
            <label>Student Name</label>
            <input type="text" name="name" placeholder="Jane Doe" required>

            <label>Student Email</label>
            <input type="email" name="email" placeholder="jane@student.com" required>

            <label>Student ID</label>
            <input type="text" name="studentId" placeholder="A00123456" required>

            <button type="submit" class="btn primary">Add Student</button>
        </form>
    </section>

    <section class="card">
        <h2>Student List</h2>
        <p class="muted">Read, review, and delete students after login.</p>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Student ID</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="5" class="empty">No students found.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $index => $student): ?>
                            <tr>
                                <td><?php echo (int)$index + 1; ?></td>
                                <td><?php echo htmlspecialchars($student['name'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($student['studentId'] ?? ''); ?></td>
                                <td><?php echo htmlspecialchars($student['email'] ?? ''); ?></td>
                                <td>
                                    <form method="post" action="index.php?action=delete-student" onsubmit="return confirm('Delete this student?');">
                                        <input type="hidden" name="id" value="<?php echo (int)($student['id'] ?? 0); ?>">
                                        <button type="submit" class="btn danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
