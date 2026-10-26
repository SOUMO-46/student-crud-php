<?php

declare(strict_types=1);
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    setErrorMessage('Invalid student ID.');
    redirect('index.php');
}

$database = new Database();
$db = $database->getConnection();

$stmt = $db->prepare('SELECT id, name, email, phone, city FROM students WHERE id = ?');
$stmt->bind_param('i', $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$student) {
    setErrorMessage('Student not found.');
    redirect('index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    [$data, $errors] = validateStudentInput($_POST);

    if ($errors) {
        setErrorMessage(implode(' ', $errors));
        redirect('update.php?id=' . $id);
    }

    try {
        $stmt = $db->prepare('UPDATE students SET name = ?, email = ?, phone = ?, city = ? WHERE id = ?');
        $stmt->bind_param('ssssi', $data['name'], $data['email'], $data['phone'], $data['city'], $id);
        $stmt->execute();
        $stmt->close();

        setSuccessMessage('Student updated successfully.');
        redirect('index.php');
    } catch (mysqli_sql_exception $e) {
        error_log($e->getMessage());
        setErrorMessage($e->getCode() === 1062 ? 'This email already exists.' : 'Unable to update student.');
        redirect('update.php?id=' . $id);
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Student | Student Manager</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <a class="brand" href="index.php">Student Manager</a>
        <a class="btn btn-light" href="index.php">← Back</a>
    </div>
</header>
<main class="container form-page">
    <section class="form-card">
        <p class="eyebrow">Record #<?= (int) $student['id'] ?></p>
        <h1>Edit Student</h1>
        <p class="muted">Update the student information and save your changes.</p>
        <?php displayMessages(); ?>
        <form action="update.php?id=<?= (int) $student['id'] ?>" method="POST" data-student-form novalidate>
            <div class="form-grid">
                <div class="field">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="<?= e($student['name']) ?>" maxlength="100" required>
                    <small class="field-error" data-error-for="name"></small>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="<?= e($student['email']) ?>" maxlength="150" required>
                    <small class="field-error" data-error-for="email"></small>
                </div>
                <div class="field">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="tel" value="<?= e($student['phone']) ?>" maxlength="20" required>
                    <small class="field-error" data-error-for="phone"></small>
                </div>
                <div class="field">
                    <label for="city">City</label>
                    <input id="city" name="city" type="text" value="<?= e($student['city']) ?>" maxlength="100" required>
                    <small class="field-error" data-error-for="city"></small>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-light" href="index.php">Cancel</a>
                <button class="btn btn-primary" type="submit">Update Student</button>
            </div>
        </form>
    </section>
</main>
<script src="assets/js/app.js"></script>
</body>
</html>
