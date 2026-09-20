<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/app.css">
    <link rel="stylesheet" href="/public/css/about.css">
</head>
<body class="page-about-new">

<?php include __DIR__ . '/../partials/spinner.php'; ?>
<?php include __DIR__ . '/../partials/navbar.php'; ?>

<main class="about-page">
    <section class="hero" id="top">
        <div class="hero-copy">
            <div class="eyebrow">
                <span></span> BEYKOZ UNIVERSITY ACADEMY
            </div>
            <h1>Sharing knowledge,<br><em>shaping the future</em><br>together.</h1>
            <p class="hero-text">
                A learning community where educators share their expertise and every member has the freedom to grow, create, and inspire.
            </p>
            <div class="hero-actions">
                <a class="primary-button" href="/public/dashboard">
                    Discover the platform
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="m12 5 7 7-7 7"></path>
                    </svg>
                </a>
            </div>
            <div class="hero-proof">
                <div class="avatar-stack">
                    <span>AY</span>
                    <span>MK</span>
                    <span>ZE</span>
                    <span>+</span>
                </div>
                <p>
                    <strong>1,200+ educators</strong><br>
                    are learning and sharing
                </p>
            </div>
        </div>

        <div class="hero-art" aria-label="Decorative illustration representing education and knowledge sharing">
            <div class="sun"></div>
            <div class="orbit orbit-one"></div>
            <div class="orbit orbit-two"></div>
            
            <div class="art-card main-card">
                <div class="card-top">
                    <span class="mini-logo">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 10v6M2 10l10-5 10 5-10 5z"></path>
                            <path d="M6 12v5c3 3 9 3 12 0v-5"></path>
                        </svg>
                    </span>
                    <span>ACADEMY</span>
                    <span class="card-dots">&bull;&bull;&bull;</span>
                </div>
                <div class="lesson-illustration">
                    <div class="book">
                        <svg width="42" height="42" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z"></path>
                            <path d="m16 12 2 2 4-4"></path>
                            <path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3"></path>
                        </svg>
                    </div>
                    <div class="sparkle s1">&#10022;</div>
                    <div class="sparkle s2">&#10022;</div>
                </div>
                <div class="course-label">FEATURED COURSE</div>
                <h3>Start your learning<br>journey today.</h3>
                <div class="progress">
                    <span></span>
                    <small>72% completed</small>
                </div>
            </div>

            <div class="floating-note note-one">
                <span class="note-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                    </svg>
                </span>
                <span><b>Fresh content</b>added every week</span>
            </div>

            <div class="floating-note note-two">
                <span class="note-icon">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                    </svg>
                </span>
                <span><b>Earn certificates</b>make your work visible</span>
            </div>
        </div>
    </section>

    <section class="quote-band">
        <p>&ldquo;Education is the strongest idea when it is shared.&rdquo;</p>
        <span>&mdash; Beykoz University Academy</span>
    </section>

    <section class="story-section" id="about">
        <div class="section-heading">
            <div class="eyebrow">
                <span></span> GET TO KNOW US
            </div>
            <h2>Learning has never<br>felt <em>this alive.</em></h2>
        </div>
        <div class="story-copy">
            <p>
                Inspired by Beykoz University&rsquo;s innovative approach to education, Academy is a living learning space where teachers share their knowledge and members discover content that moves them forward.
            </p>
            <p>
                Every course is a new beginning. Learn at your own pace, explore new disciplines, and grow alongside a community that believes in the transformative power of sharing.
            </p>
            <a class="inline-link" href="/public/dashboard">
                Browse all courses
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"></path>
                    <path d="m12 5 7 7-7 7"></path>
                </svg>
            </a>
        </div>
    </section>

    <section class="features" id="why-us">
        <div class="feature-intro">
            <span class="number">01</span>
            <h2>The Academy<br><em>difference</em></h2>
            <p>Reach the knowledge, inspiring educators, and tools for growth you need with one comprehensive membership.</p>
        </div>
        
        <div class="feature-grid">
            <article class="feature-card">
                <span class="feature-number">02</span>
                <div class="feature-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 3H2v15h7c1.7 0 3 1.3 3 3V7c0-2.2-1.8-4-4-4Z"></path>
                        <path d="m16 12 2 2 4-4"></path>
                        <path d="M22 6V3h-6c-2.2 0-4 1.8-4 4v14c0-1.7 1.3-3 3-3h7v-2.3"></path>
                    </svg>
                </div>
                <h3>One platform, limitless learning</h3>
                <p>With one subscription, access every course and up-to-date learning resource across engineering and digital disciplines.</p>
            </article>

            <article class="feature-card">
                <span class="feature-number">03</span>
                <div class="feature-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                </div>
                <h3>Created by educators</h3>
                <p>Learn from professors and teachers who share practical knowledge, research experience, and fresh perspectives.</p>
            </article>

            <article class="feature-card">
                <span class="feature-number">04</span>
                <div class="feature-icon">
                    <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="8" r="6"></circle>
                        <path d="M15.477 12.89 17 22l-5-3-5 3 1.523-9.11"></path>
                    </svg>
                </div>
                <h3>Make your progress visible</h3>
                <p>Earn official certificates that recognize your commitment and showcase the verified skills you have developed.</p>
            </article>
        </div>
    </section>

    <section class="values" id="values">
        <div>
            <div class="eyebrow light">
                <span></span> WHAT MATTERS TO US
            </div>
            <h2>Stay curious.<br><em>Share.</em> Inspire.</h2>
        </div>
        
        <div class="value-list">
            <div>
                <span class="value-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"></path>
                    </svg>
                </span>
                <span>
                    <b>People first</b>
                    <small>Every piece of educational content starts with a real human need and ambition.</small>
                </span>
            </div>

            <div>
                <span class="value-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m12 3-1.912 5.813a2 2 0 0 1-1.275 1.275L3 12l5.813 1.912a2 2 0 0 1 1.275 1.275L12 21l1.912-5.813a2 2 0 0 1 1.275-1.275L21 12l-5.813-1.912a2 2 0 0 1-1.275-1.275L12 3Z"></path>
                    </svg>
                </span>
                <span>
                    <b>Always evolving</b>
                    <small>Continuous curriculum updates designed for an ever-changing technological landscape.</small>
                </span>
            </div>

            <div>
                <span class="value-icon">
                    <svg width="19" height="19" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <polyline points="20 6 9 17 4 12"></polyline>
                    </svg>
                </span>
                <span>
                    <b>Growing together</b>
                    <small>Connecting ambitious learners and dedicated instructors into one inspiring ecosystem.</small>
                </span>
            </div>
        </div>
    </section>

    <footer class="about-footer">
        <span>&copy; 2025 Beykoz University Academy &middot; Knowledge grows when it is shared.</span>
        <div class="d-flex gap-3">
            <a href="/public/">Home</a>
            <a href="/public/dashboard">Courses</a>
            <a href="/public/trainers">Trainers</a>
            <a href="/public/certification">Certification</a>
            <a href="/public/contact">Contact</a>
        </div>
    </footer>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
