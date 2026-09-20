<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile Settings | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="page-settings">
<?php include __DIR__ . '/../partials/spinner.php'; ?>

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-5">
    <div class="card mx-auto" style="max-width: 720px;">
        <div class="card-header text-white text-center py-3" style="background-color: #2c3e50;">
            <h5 class="mb-0">Profile Settings</h5>
        </div>
        <div class="card-body px-4 py-4">

            <h6 class="mb-3 text-primary">User Info</h6>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
            <p><strong>Member Since:</strong> <?= $user['created_at'] ?></p>
            <p><strong>Membership:</strong> <?= $user['isPro'] ? 'Pro' : 'Free' ?></p>

            <hr class="my-4">

            <h6 class="mb-3 text-primary">Course Stats</h6>
            <p><strong>Enrolled Courses:</strong> <?= $course_count ?></p>
            <p><strong>Watched Videos:</strong> <?= $video_count ?></p>

            <hr class="my-4">

            <h6 class="mb-3 text-primary">Certificates</h6>
            <?php if ($certificates): ?>
                <ul class="list-group mb-3">
                    <?php foreach ($certificates as $certificate): ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <strong>Course:</strong> <?= htmlspecialchars($certificate['title']) ?> <br>
                                <small class="text-muted">Earned On: <?= date('F j, Y', strtotime($certificate['taken_at'])) ?></small>
                            </div>
                            <a href="/public/certificate?course_id=<?= $certificate['course_id'] ?>" target="_blank" class="btn btn-sm btn-outline-success">
                                <i class="bi bi-award"></i> View Certificate
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>No certificates earned yet.</p>
            <?php endif; ?>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>