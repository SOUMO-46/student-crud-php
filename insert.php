<?php

declare(strict_types=1);
require_once __DIR__ . '/message.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student | Student Manager</title>
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
        <p class="eyebrow">New record</p>
        <h1>Add Student</h1>
        <p class="muted">Enter the student details below.</p>
        <?php displayMessages(); ?>
        <form action="save.php" method="POST" data-student-form novalidate>
            <div class="form-grid">
                <div class="field">
                    <label for="name">Name</label>
                    <input id="name" name="name" type="text" value="<?= old('name') ?>" maxlength="100" autocomplete="name" required>
                    <small class="field-error" data-error-for="name"></small>
                </div>
                <div class="field">
                    <label for="email">Email</label>
                    <input id="email" name="email" type="email" value="<?= old('email') ?>" maxlength="150" autocomplete="email" required>
                    <small class="field-error" data-error-for="email"></small>
                </div>
                <div class="field">
                    <label for="phone">Phone</label>
                    <input id="phone" name="phone" type="tel" value="<?= old('phone') ?>" maxlength="20" autocomplete="tel" required>
                    <small class="field-error" data-error-for="phone"></small>
                </div>
                <div class="field">
                    <label for="city">City</label>
                    <input id="city" name="city" type="text" value="<?= old('city') ?>" maxlength="100" autocomplete="address-level2" required>
                    <small class="field-error" data-error-for="city"></small>
                </div>
            </div>
            <div class="form-actions">
                <a class="btn btn-light" href="index.php">Cancel</a>
                <button class="btn btn-primary" type="submit">Save Student</button>
            </div>
        </form>
    </section>
</main>
<script src="assets/js/app.js"></script>
</body>
</html>
