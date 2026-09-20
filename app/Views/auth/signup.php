<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&family=Playfair+Display:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Set your Google reCAPTCHA v3 Site Key if reCAPTCHA is desired -->
    <script src="https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_SITE_KEY_HERE"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Source Sans Pro', Arial, sans-serif;
            background: #f5f5f5;
            height: 100vh;
            overflow: hidden;
            line-height: 1.6;
        }

        .platform-logo {
            position: absolute;
            top: 20px;
            left: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            z-index: 1000;
        }

        .logo {
            width: 40px;
            height: 40px;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(122, 36, 44, 0.3);
        }

        .platform-info h1 {
            font-family: 'Playfair Display', serif;
            font-size: 18px;
            font-weight: 700;
            margin: 0;
            color: #7A242C;
        }

        .platform-info p {
            font-size: 11px;
            margin: 0;
            color: #A0525A;
            font-weight: 400;
        }

        .main-container {
            height: 100vh;
            display: grid;
            grid-template-columns: 1fr 380px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 60px 20px 20px;
        }

        .content-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(122, 36, 44, 0.08);
            border: 1px solid #E8D5D7;
            margin-right: 30px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .content-section h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            color: #7A242C;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .content-section p {
            color: #5A5A5A;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .benefits-list {
            list-style: none;
            margin: 20px 0;
        }

        .benefits-list li {
            padding: 8px 0;
            color: #4A4A4A;
            font-size: 13px;
            position: relative;
            padding-left: 20px;
        }

        .benefits-list li:before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #7A242C;
            font-weight: bold;
            font-size: 13px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .stat-item {
            text-align: center;
            padding: 15px;
            background: #FAF7F7;
            border-radius: 8px;
            border: 1px solid #E8D5D7;
        }

        .stat-number {
            font-size: 20px;
            font-weight: 700;
            color: #7A242C;
            display: block;
        }

        .stat-label {
            font-size: 11px;
            color: #8A6B6E;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-top: 3px;
        }

        .registration-form {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(122, 36, 44, 0.12);
            border: 1px solid #E8D5D7;
            overflow: hidden;
            height: fit-content;
        }

        .form-header {
            background: linear-gradient(135deg, #7A242C 0%, #8B3A42 100%);
            color: white;
            padding: 20px 25px;
            text-align: center;
        }

        .form-header h3 {
            font-size: 16px;
            font-weight: 600;
            margin: 0;
        }

        .form-header p {
            font-size: 12px;
            margin: 5px 0 0 0;
            opacity: 0.9;
        }

        .form-body {
            padding: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            display: block;
            margin-bottom: 4px;
            color: #4A4A4A;
            font-weight: 600;
            font-size: 12px;
        }

        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 2px solid #E8D5D7;
            border-radius: 6px;
            font-size: 13px;
            color: #4A4A4A;
            background: #ffffff;
            transition: all 0.3s ease;
            font-family: 'Source Sans Pro', sans-serif;
        }

        .form-input:focus {
            outline: none;
            border-color: #7A242C;
            box-shadow: 0 0 0 3px rgba(122, 36, 44, 0.1);
        }

        .form-input::placeholder {
            color: #B8A5A7;
        }

        .checkbox-group {
            display: flex;
            align-items: flex-start;
            gap: 8px;
            margin: 15px 0;
            padding: 10px;
            background: #FAF7F7;
            border-radius: 6px;
            border: 1px solid #E8D5D7;
        }

        .checkbox-group input[type="checkbox"] {
            margin-top: 2px;
            width: 14px;
            height: 14px;
            accent-color: #7A242C;
        }

        .checkbox-group label {
            font-size: 11px;
            color: #5A5A5A;
            line-height: 1.4;
            cursor: pointer;
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #7A242C 0%, #8B3A42 100%);
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .submit-btn:hover {
            background: linear-gradient(135deg, #8B3A42 0%, #9C4A52 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(122, 36, 44, 0.3);
        }

        .submit-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .login-link {
            text-align: center;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #E8D5D7;
            color: #8A6B6E;
            font-size: 12px;
        }

        .login-link a {
            color: #7A242C;
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-messages {
            background: #FDF2F2;
            border: 1px solid #F5B7B1;
            border-radius: 6px;
            padding: 10px;
            margin-bottom: 15px;
            color: #C0392B;
            font-size: 12px;
        }

        .error-messages ul {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .error-messages li {
            margin-bottom: 3px;
            position: relative;
            padding-left: 16px;
        }

        .error-messages li:before {
            content: "!";
            position: absolute;
            left: 0;
            width: 12px;
            height: 12px;
            background: #E74C3C;
            color: white;
            border-radius: 50%;
            font-size: 9px;
            font-weight: bold;
            text-align: center;
            line-height: 12px;
        }

        .success-container {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .success-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(122, 36, 44, 0.12);
            border: 1px solid #E8D5D7;
            overflow: hidden;
            text-align: center;
            max-width: 450px;
            width: 100%;
        }

        .success-header {
            background: linear-gradient(135deg, #27AE60 0%, #2ECC71 100%);
            color: white;
            padding: 30px 25px;
        }

        .success-icon {
            width: 50px;
            height: 50px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }

        .success-title {
            font-size: 20px;
            font-weight: 700;
            margin: 0;
        }

        .success-body {
            padding: 30px 25px;
        }

        .success-message {
            color: #5A5A5A;
            margin-bottom: 20px;
            font-size: 14px;
            line-height: 1.6;
        }

        .continue-btn {
            background: linear-gradient(135deg, #7A242C 0%, #8B3A42 100%);
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 6px;
            text-decoration: none;
            font-weight: 600;
            display: inline-block;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-size: 12px;
        }

        .continue-btn:hover {
            background: linear-gradient(135deg, #8B3A42 0%, #9C4A52 100%);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(122, 36, 44, 0.3);
        }

        .security-badge {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            margin: 10px 0;
            font-size: 11px;
            color: #8A6B6E;
        }

        .security-badge::before {
            content: "";
            font-size: 12px;
        }

        @media (max-width: 768px) {
            body {
                overflow: auto;
                height: auto;
            }

            .platform-logo {
                position: relative;
                top: 0;
                left: 0;
                justify-content: center;
                margin-bottom: 20px;
            }

            .main-container {
                grid-template-columns: 1fr;
                height: auto;
                padding: 20px 15px;
            }

            .content-section {
                margin-right: 0;
                margin-bottom: 20px;
                padding: 20px;
            }

            .platform-info h1 {
                font-size: 16px;
            }

            .content-section h2 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body>
<?php include __DIR__ . '/../partials/spinner.php'; ?>

<div class="platform-logo">
    <img src="images/favicon.png" alt="Logo" class="logo">
    <div class="platform-info">
        <h1>Open Course</h1>
        <p>Advance Your Career</p>
    </div>
</div>

<?php if (isset($registration_success) && $registration_success): ?>
    
    <div class="success-container">
        <div class="success-card">
            <div class="success-header">
                <div class="success-icon">✓</div>
                <h2 class="success-title">Registration Successful</h2>
            </div>
            <div class="success-body">
                <p class="success-message">
                    Welcome to Open Course! Your account has been successfully created.
                    You can now start exploring courses and begin your learning journey.
                </p>
                <a href="/public/login" class="continue-btn">Start Learning</a>
            </div>
        </div>
    </div>
<?php else: ?>
    
    <div class="main-container">
        
        <div class="content-section">
            <h2>Start Your Learning Journey</h2>
            <p>
                Join millions of learners worldwide on Open Course. Access thousands of high-quality courses
                taught by expert instructors. Learn new skills, advance your career, and achieve your goals
                with our comprehensive online learning platform.
            </p>

            <ul class="benefits-list">
                <li>Access to 200+ courses across all topics</li>
                <li>Learn from industry experts and professionals</li>
                <li>Flexible learning - study at your own pace</li>
                <li>Mobile app for learning on the go</li>
                <li>Certificates of completion for your achievements</li>
                <li>Lifetime access to purchased courses</li>
                <li>30-day money-back guarantee</li>
                <li>Community support and discussion forums</li>
            </ul>

            <div class="stats-grid">
                <div class="stat-item">
                    <span class="stat-number">200+</span>
                    <span class="stat-label">Courses</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">30+</span>
                    <span class="stat-label">Instructors</span>
                </div>
            </div>
        </div>

        <div class="registration-form">
            <div class="form-header">
                <h3>Create Your Account</h3>
                <p>Start learning today - it's free!</p>
            </div>
            <div class="form-body">
                <?php if (!empty($errors)): ?>
                    <div class="error-messages">
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li><?php echo htmlspecialchars($error); ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/public/signup" id="signupForm">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <div class="form-group">
                        <label class="form-label">Username</label>
                        <input
                                type="text"
                                name="Username"
                                class="form-input"
                                placeholder="Choose a username"
                                required
                                value="<?php echo isset($formUsername) ? htmlspecialchars($formUsername) : ''; ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input
                                type="email"
                                name="email"
                                class="form-input"
                                placeholder="Enter your email address"
                                required
                                value="<?php echo isset($formEmail) ? htmlspecialchars($formEmail) : ''; ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Password</label>
                        <input
                                type="password"
                                name="password"
                                class="form-input"
                                placeholder="Create a secure password"
                                required
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label">Confirm Password</label>
                        <input
                                type="password"
                                name="password2"
                                class="form-input"
                                placeholder="Confirm your password"
                                required
                        >
                    </div>

                    <div class="checkbox-group">
                        <input type="checkbox" id="terms" required>
                        <label for="terms">
                            I agree to Open Course's <strong>Terms of Use</strong> and <strong>Privacy Policy</strong>.
                            I also agree to receive course recommendations and promotional emails.
                        </label>
                    </div>

                    <input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">

                    <button type="submit" class="submit-btn" id="submitBtn">Sign Up</button>
                </form>

                <div class="login-link">
                    Already have an account? <a href="/public/login">Log in</a>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>

<script>
    // reCAPTCHA v3 implementation
    grecaptcha.ready(function() {
        const siteKey = 'YOUR_RECAPTCHA_SITE_KEY_HERE';
        const form = document.getElementById('signupForm');

        form.addEventListener('submit', function(e) {
            if (siteKey === 'YOUR_RECAPTCHA_SITE_KEY_HERE') {
                return true;
            }

            e.preventDefault();

            const submitBtn = document.getElementById('submitBtn');
            submitBtn.disabled = true;
            submitBtn.textContent = 'Processing...';

            try {
                grecaptcha.execute(siteKey, {action: 'signup'}).then(function(token) {
                    document.getElementById('g-recaptcha-response').value = token;
                    form.submit();
                }).catch(function(err) {
                    console.error('reCAPTCHA error:', err);
                    submitBtn.disabled = false;
                    submitBtn.textContent = 'Sign Up';
                    alert('Security verification failed. Please try again.');
                });
            } catch (err) {
                console.error('reCAPTCHA library error:', err);
                submitBtn.disabled = false;
                submitBtn.textContent = 'Sign Up';
                alert('Security verification failed. Please try again.');
            }
        });
    });
</script>

</body>
</html>