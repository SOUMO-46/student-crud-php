<?php

declare(strict_types=1);

require_once __DIR__ . '/database.php';
require_once __DIR__ . '/message.php';

$database = new Database();
$db = $database->getConnection();

$search = trim((string) ($_GET['search'] ?? ''));

if ($search !== '') {
    $sql = 'SELECT id, name, email, phone, city, created_at, updated_at
            FROM students
            WHERE name LIKE CONCAT("%", ?, "%")
               OR email LIKE CONCAT("%", ?, "%")
               OR phone LIKE CONCAT("%", ?, "%")
               OR city LIKE CONCAT("%", ?, "%")
            ORDER BY id DESC';
    $stmt = $db->prepare($sql);
    $stmt->bind_param('ssss', $search, $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $db->query('SELECT id, name, email, phone, city, created_at, updated_at FROM students ORDER BY id DESC');
}

$total = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Professional PHP MySQL Student CRUD application">
    <title>Student Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <a class="brand" href="index.php">Student Manager</a>
        <a class="btn btn-primary" href="insert.php">+ Add Student</a>
    </div>
</header>

<main class="container page-space">
    <?php displayMessages(); ?>

    <section class="hero-card">
        <div>
            <p class="eyebrow">PHP • MySQLi • JavaScript</p>
            <h1>Student Management</h1>
            <p class="muted">Create, view, update and delete student records from one clean dashboard.</p>
        </div>
        <div class="stat-card">
            <span>Total shown</span>
            <strong><?= $total ?></strong>
        </div>
    </section>

    <section class="panel">
        <div class="toolbar">
            <form class="search-form" method="GET" action="index.php">
                <label class="sr-only" for="search">Search students</label>
                <input id="search" name="search" type="search" value="<?= e($search) ?>" placeholder="Search name, email, phone or city...">
                <button class="btn btn-secondary" type="submit">Search</button>
                <?php if ($search !== ''): ?>
                    <a class="btn btn-light" href="index.php">Clear</a>
                <?php endif; ?>
            </form>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>Created</th>
                        <th class="actions-col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php if ($total > 0): ?>
                    <?php $studentNo = 1; while ($student = $result->fetch_assoc()): ?>
                        <tr>
                            <td data-label="No."><?= $studentNo++ ?></td>
                            <td data-label="Name"><strong><?= e($student['name']) ?></strong></td>
                            <td data-label="Email"><?= e($student['email']) ?></td>
                            <td data-label="Phone"><?= e($student['phone']) ?></td>
                            <td data-label="City"><?= e($student['city']) ?></td>
                            <td data-label="Created"><?= e($student['created_at']) ?></td>
                            <td data-label="Actions">
                                <div class="action-group">
                                    <a class="btn btn-small btn-light" href="update.php?id=<?= (int) $student['id'] ?>">Edit</a>
                                    <form class="delete-form" action="delete.php" method="POST">
                                        <input type="hidden" name="id" value="<?= (int) $student['id'] ?>">
                                        <button class="btn btn-small btn-danger" type="submit">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td class="empty" colspan="7">No students found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</main>
<script src="assets/js/app.js"></script>
</body>
</html>
