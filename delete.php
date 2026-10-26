<?php

declare(strict_types=1);
require_once __DIR__ . '/database.php';
require_once __DIR__ . '/helpers.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    setErrorMessage('Invalid request.');
    redirect('index.php');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
if (!$id || $id < 1) {
    setErrorMessage('Invalid student ID.');
    redirect('index.php');
}

$database = new Database();
$db = $database->getConnection();

try {
    $stmt = $db->prepare('DELETE FROM students WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $deleted = $stmt->affected_rows;
    $stmt->close();

    if ($deleted > 0) {
        setSuccessMessage('Student deleted successfully.');
    } else {
        setErrorMessage('Student not found.');
    }
} catch (mysqli_sql_exception $e) {
    error_log($e->getMessage());
    setErrorMessage('Unable to delete student.');
}

redirect('index.php');
