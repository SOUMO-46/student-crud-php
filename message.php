<?php

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function setSuccessMessage(string $message): void
{
    $_SESSION['success'] = $message;
}

function setErrorMessage(string $message): void
{
    $_SESSION['error'] = $message;
}

function displayMessages(): void
{
    foreach (['success' => 'alert-success', 'error' => 'alert-error'] as $key => $class) {
        if (!empty($_SESSION[$key])) {
            echo '<div class="alert ' . $class . '" role="alert">'
                . htmlspecialchars((string) $_SESSION[$key], ENT_QUOTES, 'UTF-8')
                . '</div>';
            unset($_SESSION[$key]);
        }
    }
}

function old(string $key): string
{
    return htmlspecialchars((string) ($_POST[$key] ?? ''), ENT_QUOTES, 'UTF-8');
}

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}
