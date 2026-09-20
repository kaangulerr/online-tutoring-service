<?php
/**
 * Dynamic Course Detail / Landing Page
 * Renders from database (course_details table) instead of static PHP files.
 * Variables: $course, $detail, $real_course_id
 */
$learnItems   = json_decode($detail['learn_items'] ?? '[]', true) ?: [];
$includesInfo = json_decode($detail['includes_info'] ?? '[]', true) ?: [];
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($course['title']) ?> | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="page-dynamic">
<header data-bs-theme="dark">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
</header>

<div class="container course-header">
    <div class="row">
        <div class="col-md-8">
            <?php if (!empty($detail['badge_text'])): ?>
                <p class="course-badge mb-2"><?= htmlspecialchars($detail['badge_text']) ?></p>
            <?php endif; ?>

            <h1 class="course-title"><?= htmlspecialchars($course['title']) ?></h1>

            <?php if (!empty($detail['subtitle'])): ?>
                <p class="text-muted"><?= htmlspecialchars($detail['subtitle']) ?></p>
            <?php endif; ?>

            <div class="d-flex align-items-center mb-2">
                <?php if ($detail['rating'] > 0): ?>
                    <span class="text-warning me-2"><?= number_format($detail['rating'], 1) ?> ★</span>
                <?php endif; ?>
                <small class="text-secondary">
                    <?php if ($detail['rating_count'] > 0): ?>
                        (<?= number_format($detail['rating_count']) ?> ratings)
                    <?php endif; ?>
                    <?php if ($detail['student_count'] > 0): ?>
                        • <?= number_format($detail['student_count']) ?> students
                    <?php endif; ?>
                </small>
            </div>

            <?php if (!empty($course['instructor_name'])): ?>
                <p class="text-secondary">Created by: <span class="text-dark"><?= htmlspecialchars($course['instructor_name']) ?></span></p>
            <?php endif; ?>

            <p class="text-secondary">
                <?php if (!empty($detail['last_updated'])): ?>
                    Last updated: <?= htmlspecialchars($detail['last_updated']) ?>
                <?php endif; ?>
                <?php if (!empty($detail['language'])): ?>
                    • Language: <?= htmlspecialchars($detail['language']) ?>
                <?php endif; ?>
            </p>

            <?php if (!empty($learnItems)): ?>
                <div class="box-light mt-4">
                    <h5>What You Will Learn</h5>
                    <div class="row">
                        <?php
                        $half = ceil(count($learnItems) / 2);
                        $firstHalf = array_slice($learnItems, 0, min($half, 6));
                        $secondHalf = array_slice($learnItems, min($half, 6));
                        ?>
                        <div class="col-md-6">
                            <?php foreach ($firstHalf as $item): ?>
                                <p><span class="check-icon"></span><?= htmlspecialchars($item) ?></p>
                            <?php endforeach; ?>
                        </div>
                        <div class="col-md-6">
                            <?php foreach (array_slice($learnItems, min($half, 6), 6) as $item): ?>
                                <p><span class="check-icon"></span><?= htmlspecialchars($item) ?></p>
                            <?php endforeach; ?>
                        </div>
                        <?php if (count($learnItems) > 12): ?>
                            <div class="more-topics">
                                <?php foreach (array_slice($learnItems, 12) as $item): ?>
                                    <div class="col-md-6">
                                        <p><span class="check-icon"></span><?= htmlspecialchars($item) ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <button id="showMoreBtn" class="btn btn-link text-primary p-0 mt-2">Show more</button>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="mt-4">
                <a href="/public/dashboard" class="btn btn-outline-secondary">← Explore other courses</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="box-light text-center">
                <?php if (!empty($detail['preview_video_url'])): ?>
                    <div class="video-box mb-3">
                        <iframe src="<?= htmlspecialchars($detail['preview_video_url']) ?>" width="100%" height="190" allowfullscreen></iframe>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/public/course/enroll">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <input type="hidden" name="course_id" value="<?= htmlspecialchars($real_course_id) ?>">
                    <button type="submit" class="btn btn-navbar w-100 mb-3">Enroll Now</button>
                </form>
                <p class="text-muted small">30-day money-back guarantee</p>
                <hr>

                <?php if (!empty($includesInfo)): ?>
                    <p class="text-start"><strong>This course includes:</strong></p>
                    <ul class="text-start info-list list-unstyled">
                        <?php foreach ($includesInfo as $info): ?>
                            <li><i class="bi bi-check-circle-fill text-success"></i> <?= htmlspecialchars($info) ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php if (count($learnItems) > 12): ?>
<script>
    const showMoreBtn = document.getElementById('showMoreBtn');
    const moreTopics = document.querySelector('.more-topics');
    if (showMoreBtn && moreTopics) {
        showMoreBtn.addEventListener('click', () => {
            moreTopics.style.display = 'flex';
            showMoreBtn.style.display = 'none';
        });
    }
</script>
<?php endif; ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
