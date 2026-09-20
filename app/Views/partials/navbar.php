<?php
$current_uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$is_home = ($current_uri === '/public/' || $current_uri === '/public/index.php' || $current_uri === '/' || $current_uri === '/index.php');
?>


<nav class="navbar main-navbar <?= $is_home ? 'navbar-home navbar-transparent' : '' ?> navbar-expand-lg navbar-dark fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="/public/">
            <img src="/public/images/logo-navbar.webp" alt="Logo" style="height: 30px;">
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarNav" aria-controls="navbarNav"
                aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_uri == '/public/' || $current_uri == '/public/index.php') ? 'active' : '' ?>" href="/public/">Home</a>
                </li>
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <li class="nav-item"><a class="nav-link <?= strpos($current_uri, '/login') !== false ? 'active' : '' ?>" href="/public/login">Log-In</a></li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/dashboard') !== false ? 'active' : '' ?>" href="/public/dashboard">Courses</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/trainers') !== false ? 'active' : '' ?>" href="/public/trainers">Trainers</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/certification') !== false ? 'active' : '' ?>" href="/public/certification">Certification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/pricing') !== false ? 'active' : '' ?>" href="/public/pricing">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/pet') !== false ? 'active' : '' ?>" href="/public/pet">Companion</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/progress') !== false ? 'active' : '' ?>" href="/public/progress">Progress</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= strpos($current_uri, '/about') !== false ? 'active' : '' ?>" href="/public/about">About Us</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown"
                       role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="/public/images/icon-account.png" alt="User"
                             style="width: 30px; height: 30px; border-radius: 50%; margin-right: 5px;">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li><a class="dropdown-item" href="/public/my-courses">My Courses</a></li>
                            <li><a class="dropdown-item" href="/public/progress">My Progress</a></li>
                            <li><a class="dropdown-item" href="/public/settings">Profile Settings</a></li>
                            <li><a class="dropdown-item" href="/public/logout">Log Out</a></li>
                        <?php else: ?>
                            <li><a class="dropdown-item" href="/public/login">Log-In</a></li>
                            <li><a class="dropdown-item" href="/public/admin/login">Log-In (Admin)</a></li>
                        <?php endif; ?>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
