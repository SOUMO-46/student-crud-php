<?php

declare(strict_types=1);

require_once __DIR__ . '/message.php';

function redirect(string $location): never
{
    header('Location: ' . $location);
    exit;
}

function validateStudentInput(array $input): array
{
    $data = [
        'name' => trim((string) ($input['name'] ?? '')),
        'email' => trim((string) ($input['email'] ?? '')),
        'phone' => trim((string) ($input['phone'] ?? '')),
        'city' => trim((string) ($input['city'] ?? '')),
    ];

    $errors = [];

    if ($data['name'] === '') {
        $errors['name'] = 'Name is required.';
    } elseif (mb_strlen($data['name']) < 2 || mb_strlen($data['name']) > 100) {
        $errors['name'] = 'Name must be between 2 and 100 characters.';
    }

    if ($data['email'] === '') {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    }

    if ($data['phone'] === '') {
        $errors['phone'] = 'Phone is required.';
    } elseif (!preg_match('/^[0-9+()\-\s]{7,20}$/', $data['phone'])) {
        $errors['phone'] = 'Enter a valid phone number.';
    }

    if ($data['city'] === '') {
        $errors['city'] = 'City is required.';
    } elseif (mb_strlen($data['city']) > 100) {
        $errors['city'] = 'City is too long.';
    }

    return [$data, $errors];
}
