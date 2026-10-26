<?php

declare(strict_types=1);
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setErrorMessage('Invalid request.');
    redirect('insert.php');
}

[$data, $errors] = validateStudentInput($_POST);

if ($errors) {
    setErrorMessage(implode(' ', $errors));
    redirect('insert.php');
}

$database = new Database();
$db = $database->getConnection();

try {
    $stmt = $db->prepare('INSERT INTO students (name, email, phone, city) VALUES (?, ?, ?, ?)');
    $stmt->bind_param('ssss', $data['name'], $data['email'], $data['phone'], $data['city']);
    $stmt->execute();
    $stmt->close();

    setSuccessMessage('Student added successfully.');
    redirect('index.php');
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    setErrorMessage($e->getCode() === 1062 ? 'This email already exists.' : 'Unable to save student.');
    redirect('insert.php');
}
