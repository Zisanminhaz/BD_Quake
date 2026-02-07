<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        <?= isset($page_title) ? htmlspecialchars($page_title) : 'BD Quake Safety'; ?>
    </title>

    <!-- Bootstrap CSS (CDN) -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous">

    <!-- Leaflet CSS (for shelters map, no API key needed) -->
    <link
        rel="stylesheet"
        href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
        crossorigin=""
    >

    <!-- Google Font (optional) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;700&display=swap" rel="stylesheet">

    <!-- Our CSS -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/css/style.css">
</head>
<body>
<div class="main-wrapper">

<?php
// Session-based user info for navbar
$isLoggedIn        = isset($_SESSION['user_id']);
$userName          = $_SESSION['user_name'] ?? '';
$userRole          = $_SESSION['user_role'] ?? '';
$currentController = $_GET['controller'] ?? 'home';
$currentAction     = $_GET['action'] ?? 'index';
?>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= BASE_URL ?>">
            BD Quake Safety
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Left side nav links -->
            <ul class="navbar-nav ms-auto">
                <!-- Home -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'home') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>">
                        Home
                    </a>
                </li>

                <!-- Report Building -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'report' && $currentAction === 'index') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=report&action=index">
                        Report Building
                    </a>
                </li>

                <!-- Manage Reports (admin) -->
                <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'report' && $currentAction === 'manage') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=report&action=manage">
                            Manage Reports
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Shelters -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'shelter' && $currentAction === 'index') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=shelter&action=index">
                        Shelters
                    </a>
                </li>

                <!-- Manage Shelters (admin) -->
                <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'shelter' && $currentAction === 'manage') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=shelter&action=manage">
                            Manage Shelters
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Forum -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'forum' && $currentAction === 'index') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=forum&action=index">
                        Forum
                    </a>
                </li>

                <!-- Did You Feel It? -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'felt' && $currentAction === 'index') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=felt&action=index">
                        Did You Feel It?
                    </a>
                </li>

                <!-- Manage Felt (admin) -->
                <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'felt' && $currentAction === 'manage') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=felt&action=manage">
                            Manage Felt
                        </a>
                    </li>
                <?php endif; ?>

                <!-- Guidelines (public) -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'guideline' && $currentAction === 'index') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=guideline&action=index">
                        Guidelines
                    </a>
                </li>

                <!-- FAQ (public) -->
                <li class="nav-item">
                    <a class="nav-link<?= ($currentController === 'info' && $currentAction === 'faq') ? ' active' : '' ?>"
                       href="<?= BASE_URL ?>/index.php?controller=info&action=faq">
                        FAQ
                    </a>
                </li>

                <!-- Manage Guidelines & FAQ/Contacts (admin) -->
                <?php if ($userRole === 'admin'): ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'guideline' && $currentAction === 'manage') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=guideline&action=manage">
                            Manage Guidelines
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'info' && $currentAction === 'manage') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=info&action=manage">
                            Manage FAQ/Contacts
                        </a>
                    </li>
                <?php endif; ?>
            </ul>

            <!-- Right side (auth links) -->
            <ul class="navbar-nav ms-3">
                <?php if ($isLoggedIn): ?>
                    <li class="nav-item">
                        <span class="navbar-text small me-2">
                            Hi, <?= htmlspecialchars($userName) ?>
                            <?php if ($userRole === 'admin'): ?>
                                (admin)
                            <?php endif; ?>
                        </span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"
                           href="<?= BASE_URL ?>/index.php?controller=auth&action=logout">
                            Logout
                        </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'auth' && $currentAction === 'login') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=auth&action=login">
                            Login
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link<?= ($currentController === 'auth' && $currentAction === 'register') ? ' active' : '' ?>"
                           href="<?= BASE_URL ?>/index.php?controller=auth&action=register">
                            Register
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
