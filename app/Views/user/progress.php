<?php
$totalExams = count($chartData ?? []);
$passedExams = count(array_filter($chartData ?? [], function($row) {
    return !empty($row['passed']);
}));
$avgPassed = isset($avgScore['average_score_passed']) && $avgScore['average_score_passed'] !== null
    ? round((float)$avgScore['average_score_passed'], 1)
    : 0;
$certifiedCourses = count(array_filter($completedCourses ?? [], function($course) {
    return ($course['certificate_earned'] ?? '') === 'Yes';
}));
$successRate = $totalExams > 0 ? round(($passedExams / $totalExams) * 100) : 0;
$level = max(1, min(10, floor($passedExams / 2) + 1));
$levelTitles = [
    1 => 'Curious Beginner',
    2 => 'Active Explorer',
    3 => 'Dedicated Learner',
    4 => 'Skill Builder',
    5 => 'Knowledge Seeker',
    6 => 'Advanced Learner',
    7 => 'Master Student',
    8 => 'Academic Pioneer',
    9 => 'Domain Expert',
    10 => 'Distinguished Scholar'
];
$levelTitle = $levelTitles[$level] ?? 'Advanced Learner';
$xpEarned = ($passedExams * 120) + ($certifiedCourses * 250);
$nextLevelXp = max(300, $level * 250);
$xpProgress = min(100, round(($xpEarned / $nextLevelXp) * 100));

$chartLabels = array_column($chartData ?? [], 'title');
$chartScores = array_map('floatval', array_column($chartData ?? [], 'score'));

// Fallback for visual demo if user hasn't taken exams yet
$hasExams = !empty($chartScores);
if (!$hasExams) {
    $demoLabels = ['Unit 1', 'Unit 2', 'Unit 3', 'Unit 4', 'Unit 5'];
    $demoScores = [45, 60, 72, 85, 92];
} else {
    $demoLabels = $chartLabels;
    $demoScores = $chartScores;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progress | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/public/css/app.css">
    <link rel="stylesheet" href="/public/css/progress.css?v=<?= time() ?>">
</head>
<body class="page-progress">

<?php include __DIR__ . '/../partials/spinner.php'; ?>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="progress-page">
    <section class="progress-shell">
        <div class="progress-topline">
            <div>
                <span class="progress-kicker">LEARNING OVERVIEW</span>
                <h1>Keep going, <em><?= htmlspecialchars($username) ?>.</em></h1>
                <p>Small steps become meaningful progress. Here's how your learning journey is taking shape.</p>
            </div>
            <div class="streak-badge">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z"/>
                </svg>
                <span>
                    <strong><?= max(1, $passedExams * 3) ?> days</strong>
                    <small>Learning streak</small>
                </span>
            </div>
        </div>

        <div class="progress-stat-grid">
            <article class="progress-stat progress-stat-primary">
                <div class="stat-icon">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
                        <polyline points="16 7 22 7 22 13"></polyline>
                    </svg>
                </div>
                <span>Average exam score</span>
                <strong><?= $avgPassed > 0 ? $avgPassed : '0.0' ?><small>/100</small></strong>
                <div class="mini-progress">
                    <i style="width: <?= min(100, max(0, $avgPassed)) ?>%;"></i>
                </div>
                <small class="stat-note"><?= $avgPassed >= 70 ? 'Above passing grade (+8.4%)' : 'Keep practicing to improve' ?></small>
            </article>

            <article class="progress-stat">
                <div class="stat-icon lavender">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <path d="m9 12 2 2 4-4"></path>
                    </svg>
                </div>
                <span>Exams passed</span>
                <strong><?= $passedExams ?><small> / <?= $totalExams ?></small></strong>
                <div class="mini-progress">
                    <i style="width: <?= $totalExams > 0 ? min(100, round(($passedExams / $totalExams) * 100)) : 0 ?>%;"></i>
                </div>
                <small class="stat-note"><?= $totalExams > 0 ? $successRate . '% success rate' : 'Ready for your first exam' ?></small>
            </article>

            <article class="progress-stat">
                <div class="stat-icon gold">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                    </svg>
                </div>
                <span>Certificates earned</span>
                <strong><?= $certifiedCourses ?></strong>
                <div class="certificate-dots">
                    <i class="<?= $certifiedCourses >= 1 ? 'earned' : '' ?>"></i>
                    <i class="<?= $certifiedCourses >= 2 ? 'earned' : '' ?>"></i>
                    <i class="<?= $certifiedCourses >= 3 ? 'earned' : '' ?>"></i>
                    <i class="<?= $certifiedCourses >= 4 ? 'earned' : '' ?>"></i>
                </div>
                <small class="stat-note"><?= $certifiedCourses > 0 ? $certifiedCourses . ' official credentials' : 'Earn your first certificate' ?></small>
            </article>
        </div>

        <div class="progress-main-grid">
            <section class="performance-card">
                <div class="card-heading">
                    <div>
                        <span class="card-eyebrow">YOUR PERFORMANCE</span>
                        <h2>Exam scores</h2>
                    </div>
                    <button class="period-button" type="button">
                        <?= $hasExams ? 'Last ' . count($chartScores) . ' exams' : 'Sample preview' ?> <span>&or;</span>
                    </button>
                </div>

                <div class="chart-wrap">
                    <canvas id="scoreChart"></canvas>
                </div>

                <div class="chart-footer">
                    <span><i class="legend-dot purple"></i> Exam Score</span>
                    <span><i class="legend-dot green"></i> Passed (≥70)</span>
                    <span><i class="legend-dot red"></i> Failed (<70)</span>
                    <span class="trend-up">↗ <?= $successRate ?>% success</span>
                </div>
            </section>

            <aside class="journey-card">
                <div class="journey-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                        <path d="M4 22h16"></path>
                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                    </svg>
                </div>
                <span class="card-eyebrow">YOUR JOURNEY</span>
                <h2>Level <?= $level ?></h2>
                <p><?= $levelTitle ?></p>
                <div class="level-track">
                    <i style="width: <?= $xpProgress ?>%;"></i>
                </div>
                <div class="level-meta">
                    <span><?= $xpEarned ?> XP earned</span>
                    <span><?= $nextLevelXp ?> XP</span>
                </div>
                <div class="next-unlock">
                    <span>Next unlock</span>
                    <strong>Level <?= min(10, $level + 1) ?> Achievement</strong>
                    <small><?= max(0, $nextLevelXp - $xpEarned) ?> XP to go</small>
                </div>
            </aside>
        </div>

        <section class="courses-card">
            <div class="card-heading">
                <div>
                    <span class="card-eyebrow">RECENT ACTIVITY</span>
                    <h2>Completed courses</h2>
                </div>
                <a href="/public/dashboard">View all courses <span>&rarr;</span></a>
            </div>

            <div class="course-list">
                <?php if (!empty($completedCourses)): ?>
                    <?php foreach ($completedCourses as $index => $course): ?>
                        <?php 
                        $isPassed = ($course['score'] ?? 0) >= 70;
                        ?>
                        <article class="course-row">
                            <div class="course-number <?= $isPassed ? '' : 'review' ?>">
                                <?php if ($isPassed): ?>
                                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                        <polyline points="20 6 9 17 4 12"></polyline>
                                    </svg>
                                <?php else: ?>
                                    !
                                <?php endif; ?>
                            </div>
                            <div class="course-name">
                                <strong><?= htmlspecialchars($course['title']) ?></strong>
                                <span><?= htmlspecialchars($course['taken_at']) ?></span>
                            </div>
                            <div class="score <?= $isPassed ? '' : 'needs-review' ?>">
                                <?= $course['score'] ?><small>/100</small>
                            </div>
                            <span class="course-status <?= $isPassed ? 'passed' : 'review-status' ?>">
                                <?= $isPassed ? 'Passed' : 'Needs review' ?>
                            </span>
                            <a href="/public/dashboard" class="row-action" title="Open course" aria-label="Open course">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor">
                                    <polygon points="6 3 20 12 6 21 6 3"></polygon>
                                </svg>
                            </a>
                        </article>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty-state">
                        <p>No completed course exams yet. Start learning today!</p>
                        <a href="/public/dashboard">Explore courses &rarr;</a>
                    </div>
                <?php endif; ?>
            </div>
        </section>

        <div class="progress-bottom-grid">
            <div class="tip-card">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                    <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                </svg>
                <div>
                    <strong>Keep your momentum</strong>
                    <p>One more course this week could bring you closer to your next certificate.</p>
                </div>
                <a href="/public/dashboard">Explore courses &rarr;</a>
            </div>

            <div class="payment-card">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect width="20" height="14" x="2" y="5" rx="2"></rect>
                    <line x1="2" x2="22" y1="10" y2="10"></line>
                </svg>
                <div>
                    <span>Membership</span>
                    <strong><?= !empty($payment['last_payment']) ? 'Active subscription' : 'Free access' ?></strong>
                    <small><?= !empty($payment['last_payment']) ? 'Last payment: ' . htmlspecialchars($payment['last_payment']) : 'No payment recorded' ?></small>
                </div>
                <a href="/public/payment" class="manage-btn">Manage</a>
            </div>
        </div>
    </section>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const canvas = document.getElementById('scoreChart');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    const gradient = ctx.createLinearGradient(0, 0, 0, 240);
    gradient.addColorStop(0, 'rgba(91, 75, 219, 0.22)');
    gradient.addColorStop(1, 'rgba(91, 75, 219, 0.0)');

    const labels = <?= json_encode($demoLabels) ?>;
    const scores = <?= json_encode($demoScores) ?>;

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Exam Score',
                data: scores,
                backgroundColor: gradient,
                borderColor: '#5b4bdb',
                borderWidth: 3.5,
                tension: 0.4,
                fill: true,
                pointBackgroundColor: function(context) {
                    return (context.raw >= 70) ? '#1ca67a' : '#e54d42';
                },
                pointBorderColor: '#ffffff',
                pointBorderWidth: 2,
                pointRadius: 5,
                pointHoverRadius: 7
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#20243a',
                    titleFont: { family: 'DM Sans', size: 13, weight: 'bold' },
                    bodyFont: { family: 'DM Sans', size: 12 },
                    padding: 10,
                    cornerRadius: 8,
                    displayColors: false,
                    callbacks: {
                        label: function(ctx) {
                            return 'Score: ' + ctx.parsed.y + (ctx.parsed.y >= 70 ? ' (Passed)' : ' (Failed)');
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 100,
                    grid: {
                        color: 'rgba(232, 221, 213, 0.6)',
                        drawBorder: false
                    },
                    ticks: {
                        font: { family: 'DM Sans', size: 11 },
                        color: '#777c91',
                        callback: function(v) { return v; }
                    }
                },
                x: {
                    grid: { display: false, drawBorder: false },
                    ticks: {
                        font: { family: 'DM Sans', size: 11 },
                        color: '#777c91',
                        maxRotation: 0,
                        autoSkip: true,
                        maxTicksLimit: 7
                    }
                }
            }
        }
    });
});
</script>
</body>
</html>