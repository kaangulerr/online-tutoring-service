<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Companion | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/app.css">
    <link rel="stylesheet" href="/public/css/pet.css?v=<?= time() ?>">
</head>
<body class="page-pet-new">

<?php include __DIR__ . '/../partials/spinner.php'; ?>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="pet-page">
    <section class="companion-shell" id="top">
        <div class="pet-header">
            <div class="eyebrow">
                <span></span> YOUR LEARNING COMPANION
            </div>
            <h1>Grow your companion<br><em>as you grow.</em></h1>
            <p>
                Every lesson watched, exam passed, and certificate earned brings your companion one step closer to its next evolution.
            </p>
        </div>

        <div class="pet-stage">
            <div class="stage-glow"></div>
            <div class="level-pill">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"></polygon>
                </svg>
                LEVEL <?= sprintf('%02d', $pet_level) ?>
            </div>
            
            <div class="pet-orbit orbit-a"></div>
            <div class="pet-orbit orbit-b"></div>

            <img id="petImage" 
                 class="companion-image <?= $progress < 20 ? 'level-up' : '' ?>" 
                 src="<?= !empty($pet_image) ? htmlspecialchars($pet_image) : '/public/images/pet-companion-cat.png' ?>" 
                 alt="<?= htmlspecialchars($pet['pet_name'] ?? 'Learning Companion') ?>" 
                 title="Click to interact with your companion!"
                 onclick="petAction('pet')">

            <div class="stage-spark spark-one">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                </svg>
            </div>
            
            <div class="stage-spark spark-two">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="1">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                </svg>
            </div>

            <div class="pet-name">
                <h2><?= htmlspecialchars($pet['pet_name'] ?? 'Paw Companion') ?></h2>
                <p><?= number_format($total_points) ?> total XP</p>
            </div>
        </div>

        <div class="progress-wrap">
            <div class="progress-label">
                <span>Level <?= $pet_level ?></span>
                <strong><?= $progress ?>% to next level</strong>
            </div>
            <div class="progress-track">
                <span style="width: <?= $progress ?>%;"></span>
            </div>
            <div class="progress-caption">
                <span>Keep learning to unlock a new evolution</span>
                <span><?= $progress * 10 ?> / 1,000 XP</span>
            </div>
        </div>

        <div class="stats-grid">
            <article class="stat-card">
                <div class="stat-icon blue">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="23 7 16 12 23 17 23 7"></polygon>
                        <rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect>
                    </svg>
                </div>
                <div>
                    <span>Watched lessons</span>
                    <strong><?= number_format($video_count) ?></strong>
                    <small>+<?= number_format($video_points) ?> XP earned</small>
                </div>
                <div class="stat-arrow">&nearr;</div>
            </article>

            <article class="stat-card">
                <div class="stat-icon gold">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                    </svg>
                </div>
                <div>
                    <span>Certificates earned</span>
                    <strong><?= number_format($passed_count) ?></strong>
                    <small>+<?= number_format($exam_points) ?> XP earned</small>
                </div>
                <div class="stat-arrow">&nearr;</div>
            </article>

            <article class="stat-card">
                <div class="stat-icon rose">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                        <path d="M4 22h16"></path>
                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                    </svg>
                </div>
                <div>
                    <span>Companion Rank</span>
                    <strong>Tier <?= $pet_level ?></strong>
                    <small>Active &amp; Thriving</small>
                </div>
                <div class="stat-arrow">&nearr;</div>
            </article>
        </div>

        <section class="activity-panel">
            <div class="panel-heading">
                <div>
                    <span class="eyebrow">
                        <span></span> DAILY MOMENTS
                    </span>
                    <h2>Spend time together</h2>
                </div>
                <span class="activity-date">Today&rsquo;s mood: <b>Happy</b></span>
            </div>

            <div class="action-grid">
                <button type="button" onclick="petAction('pet')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                    </svg>
                    <span>
                        <b>Pet</b>
                        <small>Show some love</small>
                    </span>
                </button>

                <button type="button" onclick="petAction('dance')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path>
                        <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path>
                    </svg>
                    <span>
                        <b>Learn together</b>
                        <small>Celebrate progress</small>
                    </span>
                </button>

                <button type="button" onclick="petAction('play')">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polygon points="5 3 19 12 5 21 5 3"></polygon>
                    </svg>
                    <span>
                        <b>Play</b>
                        <small>Take a joyful break</small>
                    </span>
                </button>
            </div>
        </section>
    </section>

    <div id="petToast" class="pet-toast d-none" role="status"></div>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let toastTimeout = null;

    function petAction(action) {
        const pet = document.getElementById('petImage');
        if (!pet) return;

        pet.classList.remove('pet-happy', 'pet-dance', 'pet-jump');
        void pet.offsetWidth;

        const animMap = {
            pet: 'pet-happy',
            dance: 'pet-dance',
            play: 'pet-jump'
        };

        const animClass = animMap[action] || 'pet-happy';
        pet.classList.add(animClass);

        setTimeout(() => {
            pet.classList.remove(animClass);
        }, 1000);

        const messages = {
            pet: 'Your companion is feeling loved.',
            dance: 'Your companion is dancing with joy.',
            play: 'Great play session. Keep learning!'
        };

        showToast(messages[action] || 'Your companion loves spending time with you.');
    }

    function showToast(message) {
        const toast = document.getElementById('petToast');
        if (!toast) return;

        if (toastTimeout) {
            clearTimeout(toastTimeout);
        }

        toast.textContent = message;
        toast.classList.remove('d-none');

        toastTimeout = setTimeout(() => {
            toast.classList.add('d-none');
        }, 2400);
    }

    window.addEventListener('load', () => {
        const progress = <?= (int)$progress ?>;
        if (progress < 20) {
            const pet = document.getElementById('petImage');
            if (pet) {
                pet.classList.add('level-up');
                setTimeout(() => {
                    showToast('New level! You reached level <?= (int)$pet_level ?>!');
                }, 600);
            }
        }
    });
</script>
</body>
</html>