

<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">
<head>
    <meta charset="utf-8">
    <title>Checkout | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="page-payment bg-light">

<div class="container py-5">
    <main>
        <div class="text-center mb-4">
            <img src="/public/images/icon-payment.webp" alt="Logo" width="50" height="50">
            <h2>Checkout Form</h2>
            <p class="lead">Please fill in the form to complete your purchase.</p>
        </div>

        <form class="needs-validation" novalidate method="POST">
            <?= \App\Core\CSRF::csrfField() ?? '' ?>
            <div class="row g-5">
                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-primary">Your cart</span>
                        <span class="badge bg-primary rounded-pill">1</span>
                    </h4>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm">
                            <div>
                                <h6 class="my-0">Engineering Course</h6>
                                <small class="text-muted">Course ID: <?php echo htmlspecialchars($courses_id ?? 'PRO-PLAN'); ?></small>
                            </div>
                            <span>$15</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total</span>
                            <strong>$15</strong>
                        </li>
                    </ul>
                </div>

                <div class="col-md-7 col-lg-8">
                    <h4 class="mb-3">Billing address</h4>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label">Last name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Address</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label">Country</label>
                            <select class="form-select" required>
                                <option value="">Choose...</option>
                                <option>Turkey</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">State</label>
                            <select class="form-select" required>
                                <option value="">Choose...</option>
                                <option>Istanbul</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Zip</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>

                    <hr class="my-4">
                    <h4 class="mb-3">Payment</h4>
                    <div class="my-3">
                        <div class="form-check">
                            <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                            <label class="form-check-label" for="credit">Credit card</label>
                        </div>
                        <div class="form-check">
                            <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                            <label class="form-check-label" for="debit">Debit card</label>
                        </div>
                    </div>

                    <div class="row gy-3">
                        <div class="col-md-6">
                            <label class="form-label">Name on card</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Card number</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Expiration</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">CVV</label>
                            <input type="text" class="form-control" required>
                        </div>
                    </div>

                    <hr class="my-4">
                    <button class="w-100 btn btn-primary btn-lg" type="submit">Complete Payment</button>
                </div>
            </div>
        </form>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
    (() => {
        'use strict';
        const forms = document.querySelectorAll('.needs-validation');
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    })();
</script>
</body>
</html>
