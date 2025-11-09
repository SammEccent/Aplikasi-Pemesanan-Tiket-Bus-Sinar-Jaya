<?php

/**
 * Header template
 * @var string $pageTitle - Title of the current page
 */

// Logic to determine the active page for sidebar styling
$current_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
if ($current_path === false) {
    $current_path = '/';
}

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
    <div class="app-container">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <a href="<?= BASEURL ?>" class="brand-link" title="Sinar Jaya Home">
                    <svg class="brand-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18.3636 16H5.63636C4.95364 16 4.5 15.5464 4.5 14.8636V9.13636C4.5 8.45364 4.95364 8 5.63636 8H18.3636C19.0464 8 19.5 8.45364 19.5 9.13636V14.8636C19.5 15.5464 19.0464 16 18.3636 16Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M6 8V6C6 4.89543 6.89543 4 8 4H16C17.1046 4 18 4.89543 18 6V8" stroke="currentColor" stroke-width="1.5" />
                        <circle cx="7.5" cy="18.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                        <circle cx="16.5" cy="18.5" r="1.5" stroke="currentColor" stroke-width="1.5" />
                    </svg>
                    <span class="brand-text-group"><span class="logo-text">Sinar Jaya</span></span>
                </a>
            </div>

            <nav class="sidebar-nav">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>" class="nav-link <?= ($current_path == '/') ? 'active' : '' ?>" title="Beranda">
                            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3 9.5L12 4L21 9.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M19 13V20.5H5V13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="nav-text">Beranda</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" title="Cari Tiket">
                            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M15.5 15.5L19 19" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5 11C5 14.3137 7.68629 17 11 17C12.6597 17 14.1652 16.3773 15.2483 15.3773C16.321 14.3873 17 12.894 17 11C17 7.68629 14.3137 5 11 5C7.68629 5 5 7.68629 5 11Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="nav-text">Cari Tiket</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link" title="Pemesanan Saya">
                            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.6 2H14.4C18.4 2 22 5.6 22 9.6V14.4C22 18.4 18.4 22 14.4 22H9.6C5.6 22 2 18.4 2 14.4V9.6C2 5.6 5.6 2 9.6 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M15 18L9 18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 14L8 14" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16 10L8 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M12 6L12 7" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="nav-text">Pemesanan Saya</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= BASEURL ?>auth/profile" class="nav-link <?= (strpos($current_path, '/auth/') !== false) ? 'active' : '' ?>" title="Akun">
                            <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2C9.23858 2 7 4.23858 7 7C7 9.76142 9.23858 12 12 12C14.7614 12 17 9.76142 17 7C17 4.23858 14.7614 2 12 2Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M20.5858 22C20.5858 18.134 16.7279 15 12 15C7.27208 15 3.41421 18.134 3.41421 22" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <span class="nav-text">Akun</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="sidebar-footer">
                <button id="sidebar-toggle" class="sidebar-toggle" title="Sembunyikan Sidebar">
                    <svg class="icon-collapse" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M10.75 4.75a.75.75 0 00-1.5 0v14.5a.75.75 0 001.5 0V4.75zM5.25 4a.75.75 0 00-.75.75v14.5a.75.75 0 001.5 0V4.75A.75.75 0 005.25 4zM15 12a.75.75 0 01.22-.53l3.25-3.25a.75.75 0 111.06 1.06L16.81 12l2.72 2.72a.75.75 0 11-1.06 1.06l-3.25-3.25A.75.75 0 0115 12z" />
                    </svg>
                    <svg class="icon-expand" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M13.25 4.75a.75.75 0 011.5 0v14.5a.75.75 0 01-1.5 0V4.75zM18.75 4a.75.75 0 01.75.75v14.5a.75.75 0 01-1.5 0V4.75a.75.75 0 01.75-.75zM9 12a.75.75 0 00-.22.53l-3.25 3.25a.75.75 0 101.06 1.06L9.31 12l-2.72-2.72a.75.75 0 10-1.06 1.06l3.25 3.25A.75.75 0 009 12z" />
                    </svg>
                </button>

                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/auth/logout" class="nav-link" title="Logout">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 12H3" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M8 7L3 12L8 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M15 4H19C19.5304 4 20.0391 4.21071 20.4142 4.58579C20.7893 4.96086 21 5.46957 21 6V18C21 18.5304 20.7893 19.0391 20.4142 19.4142C20.0391 19.7893 19.5304 20 19 20H15" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="nav-text">Logout</span>
                    </a>
                <?php else: ?>
                    <a href="/auth/login" class="nav-link" title="Sign In">
                        <svg class="nav-icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9 12H21" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M16 7L21 12L16 17" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9 20H5C4.46957 20 3.96086 19.7893 3.58579 19.4142C3.21071 19.0391 3 18.5304 3 18V6C3 5.46957 3.21071 4.96086 3.58579 4.58579C3.96086 4.21071 4.46957 4 5 4H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <span class="nav-text">Sign In</span>
                    </a>
                <?php endif; ?>
            </div>
        </aside>

        <div class="main-content">
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