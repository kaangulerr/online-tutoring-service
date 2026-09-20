<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="../../public/assets/js/color-modes.js"></script>

    <meta charset="utf-8">
    <title>Courses | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/album/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="/public/css/app.css?v=<?= time() ?>">
    <style>
        body.page-dashboard,
        .page-dashboard .album {
            background-color: #f8f3ed !important;
            background: #f8f3ed !important;
        }
    </style>
</head>
<body class="page-dashboard" style="background-color: #f8f3ed !important;">

<?php include __DIR__ . '/../partials/spinner.php'; ?>

<?php include __DIR__ . '/../partials/toast.php'; ?>

<header data-bs-theme="dark">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
</header>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<div class="dropdown position-fixed bottom-0 start-0 mb-3 ms-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                Light
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                Dark
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
                Auto
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
    </ul>
</div>

<main>
    <section class="py-5 text-center container">
        <div class="row py-lg-5">
            <div class="col-lg-6 col-md-8 mx-auto">
                <?php if (isset($_SESSION['username'])): ?>
                    <h5 class="text-muted mb-4">Welcome, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></h5>
                <?php endif; ?>
                <h1 class="fw-light"><?php echo isset($is_my_courses) && $is_my_courses ? 'My Courses' : 'Courses'; ?></h1>
                <p class="lead text-body-secondary">
                    <?php echo isset($is_my_courses) && $is_my_courses 
                        ? 'Here are the courses you are currently enrolled in.' 
                        : 'Explore our collection of engineering courses designed to enhance your skills and knowledge.'; ?>
                </p>

            </div>
        </div>
    </section>

    <div class="album py-5" style="background-color: #f8f3ed !important;">
        <div class="container">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">

                <?php
                if (empty($courses) && isset($is_my_courses) && $is_my_courses) {
                    echo "<div class='col-12 text-center my-5'>
                            <p class='lead'>You haven't enrolled in any courses yet.</p>
                            <a href='/public/dashboard' class='btn btn-primary mt-3' style='background-color:#9f4e58; border:none;'>Browse Courses</a>
                          </div>";
                }
                try {
                    foreach ($courses as $row) {
                        $stars = "";
                        for ($i = 0; $i < 5; $i++) {
                            $stars .= "<li><span class='fa " . ($i < $row['rating'] ? "fa-star" : "fa-star-o") . "'></span></li>";
                        }

                        $detail_link = htmlspecialchars($row['detail_link'] ?? '');
                        if (empty($detail_link) && !empty($row['code'])) {
                            $detail_link = '/public/course-details/' . urlencode($row['code']);
                        }
                        
                        $target_link = (isset($is_my_courses) && $is_my_courses) ? '/public/course/' . $row['id'] : $detail_link;
                        $image_path = htmlspecialchars($row['image_path'] ?? '');
                        $title = htmlspecialchars($row['title'] ?? '');
                        $instructor_image = htmlspecialchars($row['instructor_image'] ?? '');
                        $instructor_name = htmlspecialchars($row['instructor_name'] ?? '');
                        $code = htmlspecialchars($row['code'] ?? '');

                        echo "
                    <div class='col'>
                        <div class='course-card'>
                            <div class='course-card-header'>
                                <a href='{$target_link}' class='image-zoom'>
                                    <img class='card-image-bottom' src='{$image_path}' alt='Course Image'>
                                </a>
                            </div>
                            <div class='course-card-body'>
                                <div class='pricing-rating'>
                                </div>
                                <a href='{$target_link}' class='course-title'>{$title}</a>
                            </div>
                            <div class='course-card-footer'>
                                <div class='instructor-info'>
                                    <img src='{$instructor_image}' alt='Instructor'>
                                    <ul class='course-meta'>
                                        <li><span class='meta-label'>by</span> <a href='/public/trainers'>{$instructor_name}</a></li>
                                        <li><a href='{$target_link}'>{$code}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    ";
                    }
                } catch (PDOException $e) {
                    echo "Data fetching error: " . $e->getMessage();
                }
                ?>

            </div>
        </div>
    </div>
</main>

<footer class="text-body-secondary py-5">
    <div class="container">
        <p class="float-end mb-1">
            <a href="#">Back to top</a>
        </p>
        <p class="mb-1">Course catalog © 2025</p>
        <p class="mb-0">New to our platform? <a href="/">Visit the homepage</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="/public/js/app.js"></script>
</body>
</html>