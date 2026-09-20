<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Log In | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Optional: Set your Google reCAPTCHA v3 Site Key if reCAPTCHA is desired -->
    <script src="https://www.google.com/recaptcha/api.js?render=YOUR_RECAPTCHA_SITE_KEY_HERE"></script>
    <link rel="stylesheet" href="/public/css/app.css">
<style>
* {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .error-message {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: #ff0000;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            z-index: 1000;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }

        .left-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            animation: fadeIn 3.5s forwards;
            background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('/public/images/auth-login-banner.webp');
            background-repeat: no-repeat;
            text-shadow: 0 0.05rem 0.1rem rgba(0, 0, 0, 0.1);
            box-shadow: inset 0 0 5rem rgba(0, 0, 0, 0.1);

        }

        .right-section {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            min-width: 300px;
            max-width: 500px;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        .login-container {
            max-width: 400px;
            width: 100%;
        }

        .header {
            font-size: 40px;
            font-weight: 700;
            color: #a00;
            margin-bottom: 2rem;
            font-family: "Garamond", "Times New Roman", serif;
            display: flex;
            align-items: center;
            letter-spacing: -0.5px;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.2);
        }

        h2 {
            font-size: 1.45rem;
            margin-bottom: 1rem;
        }

        input[type="email"] {
            width: 100%;
            padding: 12px 0;
            margin: 10px 0;
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            font-size: 1rem;
        }

        input[type="email"]:focus {
            outline: none;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px 0;
            margin: 10px 0;
            border: none;
            border-bottom: 1px solid #000;
            border-radius: 0;
            font-size: 1rem;
        }

        input[type="password"]:focus {
            outline: none;
        }

        .linkk {
            color: #666;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-top: 13px;

        }

        .link2 {
            color: #0078d4;
            text-decoration: none;
            font-size: 0.9rem;
            display: block;
            margin-top: 13px;
        }

        .linkk:hover,
        .link2:hover {
            text-decoration: underline;
        }

        .link {
            color: #0078d4;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .link:hover {
            text-decoration: underline;
        }

        .btn {
            width: 100%;
            padding: 12px;
            margin: 20px 0;
            background-color: #9f4e58;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #7A242C;
        }

        .footer {
            position: fixed;
            bottom: 10px;
            right: 270px;
            font-size: 0.8rem;
            color: #666;
            z-index: 1000;
        }

        @media (max-width: 768px) {
            body {
                flex-direction: column;
            }

            .left-section {
                height: 40vh;
            }
        }

        .footer a {
            color: inherit;
            text-decoration: none;
            margin-left: 5px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .top-logo {
            position: fixed;
            top: 1rem;
            right: 1rem;
            padding: 10px;
            cursor: default;
            z-index: 1000;
        }

        .top-logo img {
            width: 45px;
            height: 45px;
            display: block;
        }

        .info-text {
            font-size: 0.9rem;
            color: #333;
            margin-top: 1rem;
            margin-bottom: 1rem;
            text-align: left;
        }
        .text strong {
            font-size: 14px;
            color: black;
        }

        .text span {
            font-size: 12px;
            color: #666;
        }
        #loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            z-index: 9999;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            justify-content: center;
            align-items: center;
        }

        #loading-overlay {
            display: none;
            position: fixed;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            z-index: 9999;
            justify-content: center;
            align-items: center;
        }
</style>
</head>
<body class="page-login">

<div id="loading-overlay">Verifying...</div>

<?php if (!empty($error_message)): ?>
    <div class="error-message"><?php echo $error_message; ?></div>
<?php endif; ?>

<div class="left-section"></div>

<div class="right-section">
    <div class="login-container" id="loginContainer">
        <div class="header">Online Tutoring Service</div>
        <h2 id="loginTitle">Sign In</h2>
        <div id="mainForm">
            <form id="login-form" action="/public/login" method="post">
                <?= \App\Core\CSRF::csrfField() ?>
                <input type="email" name="email" placeholder="Enter your email address" required>
                <input type="password" name="password" placeholder="Enter your password" required>

                <a href="/public/signup" class="link2">Don't have an account yet?</a>
                <a href="/public/password-reset" class="linkk">Can't access your account?</a>
                <button type="submit" class="btn">Submit</button>

                <p class="info-text" id="infoText1">Please log in using the email address and password you registered with.</p>
                <p class="info-text" id="infoText2">For 24/7 service and support, visit the <a href="/public/contact" class="link" id="techServicePortal">Tech Service Portal</a></p>
            </form>

            <div class="top-logo">
                <a href="/public/">
                    <img src="images/favicon.png" alt="Icon">
                </a>
            </div>

            <div class="footer">
                <a href="#">Digital Accessibility</a> | <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('login-form');
        const overlay = document.getElementById('loading-overlay');
        const siteKey = 'YOUR_RECAPTCHA_SITE_KEY_HERE';

        form.addEventListener('submit', function (e) {
            if (siteKey === 'YOUR_RECAPTCHA_SITE_KEY_HERE') {
                // If the key is not set, allow the form to submit normally without reCAPTCHA
                return true;
            }

            e.preventDefault();
            overlay.style.display = 'flex';

            try {
                grecaptcha.ready(function () {
                    grecaptcha.execute(siteKey, { action: 'submit' }).then(function (token) {
                        const tokenInput = document.createElement('input');
                        tokenInput.type = 'hidden';
                        tokenInput.name = 'g-recaptcha-response';
                        tokenInput.value = token;
                        form.appendChild(tokenInput);
                        form.submit();
                    }).catch(function(err) {
                        console.error('reCAPTCHA error:', err);
                        alert('reCAPTCHA failed. Please check your Site Key.');
                        overlay.style.display = 'none';
                    });
                });
            } catch (err) {
                console.error('reCAPTCHA library error:', err);
                alert('reCAPTCHA failed to load. Please check your Site Key.');
                overlay.style.display = 'none';
            }
        });
    });
</script>

</body>
</html>
