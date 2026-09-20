<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
<style>
body {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            margin: 0;
        }
        .login-wrapper {
            width: 100%;
            max-width: 420px;
            padding: 20px;
        }
        .login-card {
            background: #ffffff;
            padding: 50px 40px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            border: none;
        }
        .brand-icon {
            width: 64px;
            height: 64px;
            background: #f8f9fa;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 25px;
            color: #1e3c72;
        }
        .login-card h3 { 
            margin-bottom: 30px; 
            font-weight: 600; 
            text-align: center; 
            color: #2b3445;
            font-size: 1.5rem;
        }
        .form-floating > .form-control:focus ~ label,
        .form-floating > .form-control:not(:placeholder-shown) ~ label {
            color: #1e3c72;
        }
        .form-control:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.25rem rgba(30, 60, 114, 0.1);
        }
        .btn-login { 
            width: 100%;
            padding: 12px;
            font-weight: 500;
            background: #1e3c72;
            border: none;
            border-radius: 8px;
            margin-top: 15px;
            transition: all 0.3s ease;
        }
        .btn-login:hover {
            background: #152b53;
            transform: translateY(-1px);
        }
        .alert {
            font-size: 0.9rem;
            border-radius: 8px;
        }
        .footer-text {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.85rem;
            margin-top: 25px;
        }
</style>
</head>
<body class="page-login">

<div class="login-wrapper">
    <div class="login-card">
        <div class="brand-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" viewBox="0 0 16 16">
                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
            </svg>
        </div>
        <h3>Admin Access</h3>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger text-center p-2 mb-4">
                <small><?= htmlspecialchars($error) ?></small>
            </div>
        <?php endif; ?>

        <form method="POST" action="/public/admin/login">
            <?= \App\Core\CSRF::csrfField() ?>
            <div class="form-floating mb-3">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="Username" required>
                <label for="floatingInput">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password" required>
                <label for="floatingPassword">Password</label>
            </div>
            <button type="submit" class="btn btn-primary btn-login">Secure Login</button>
        </form>
    </div>
    <div class="footer-text">
        &copy; 2025 Online Tutoring Service. All rights reserved.
    </div>
</div>

</body>
</html>
