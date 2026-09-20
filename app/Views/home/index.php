<?php include __DIR__ . '/../partials/index.php'; ?>
<?php include __DIR__ . '/../partials/cookies.php'; ?>

<?php if (!empty($error_message)): ?>
    <div class="error-message"><?php echo htmlspecialchars($error_message); ?></div>
<?php endif; ?>

<?php if (!empty($success_message)): ?>
    <div class="sent-message"><?php echo htmlspecialchars($success_message); ?></div>
<?php endif; ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="/public/css/app.css">
</head>

<body class="page-index">

<footer class="container-fluid py-4" style="background-color:w;">
    <div class="container">
        <p class="float-end"><a href="#">Back to top</a></p>
        <p>&copy; 2025 Online Tutoring Service &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
<script>
    window.onload = function() {
        const cookieConsent = localStorage.getItem('cookieConsent');
        if (cookieConsent === 'accepted') {
            const overlay = document.getElementById('pageOverlay');
            if (overlay) overlay.style.display = 'none';
        } else {
            const overlay = document.getElementById('pageOverlay');
            if (overlay) overlay.style.display = 'flex';
        }
    }

    function acceptCookies() {
        localStorage.setItem('cookieConsent', 'accepted');
        const overlay = document.getElementById('pageOverlay');
        if (overlay) overlay.style.display = 'none';
    }
</script>
</body>
</html>
