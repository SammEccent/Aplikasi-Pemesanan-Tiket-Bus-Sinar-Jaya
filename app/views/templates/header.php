<?php

/**
 * Header template
 * @var string $pageTitle - Title of the current page
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : 'Sinar Jaya Premium Bus Travel' ?></title>
    <base href="<?= BASEURL ?>">
    <link rel="stylesheet" href="/css/style.css?v=<?= filemtime('css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>

<body>
    <header class="main-header">
        <div class="logo">
            <a href="<?= BASEURL ?>" class="logo-text">Sinar Jaya</a>
            <span class="logo-tagline">Premium Travel</span>
        </div>
        <nav class="auth-nav">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/auth/profile" class="nav-link profile-link">
                    <svg class="profile-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd" />
                    </svg>
                    <span><?= $_SESSION['fullname'] ?></span>
                </a>
                <a href="/auth/logout" class="nav-link signup">Logout</a>
            <?php else: ?>
                <a href="/auth/login" class="nav-link signin">Sign In</a>
                <a href="/auth/register" class="nav-link signup">Sign Up</a>
            <?php endif; ?>
        </nav>
    </header>

    <?php
    // Flash Message Logic
    if (isset($_SESSION['success'])) {
        echo '<div class="flash-message success">' . $_SESSION['success'] . '</div>';
        unset($_SESSION['success']);
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="flash-message error">' . $_SESSION['error'] . '</div>';
        unset($_SESSION['error']);
    }
    ?>