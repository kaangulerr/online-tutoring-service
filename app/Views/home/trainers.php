<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Trainers | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <link rel="stylesheet" href="/public/css/app.css?v=<?= time() ?>">
    <style>
        body.page-trainers {
            background-color: #f8f3ed !important;
            background: #f8f3ed !important;
        }
    </style>
</head>

<body class="page-trainers" style="background-color: #f8f3ed !important;">
<?php include __DIR__ . '/../partials/spinner.php'; ?>

<section class="py-5 text-center container">
    <div class="row py-lg-5">
        <div class="col-lg-6 col-md-8 mx-auto">
            <h1 class="fw-light">Our Trainers</h1>
            <p class="lead text-body-secondary">Explore our collection of engineering courses designed to enhance your skills and knowledge.</p>
            <p>
                <a href="/public/dashboard" class="btn btn-primary my-2">Browse All Courses</a>
                <a href="#" class="btn btn-secondary my-2">Learn More</a>
            </p>
        </div>
    </div>
</section>

<?php include __DIR__ . '/../partials/navbar.php'; ?>
</header>

<section id="trainers" class="trainers py-5">
    <div class="container">
        <div class="row gy-5">
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="100">
                <div class="member-img">
                    <img src="/public/images/instructor-ahmet-yilmaz.jpg" class="img-fluid" alt="Prof. Dr. Ahmet Yılmaz">
                </div>
                <div class="member-info text-center">
                    <h4>Prof. Dr. Ahmet Yılmaz</h4>
                    <span>Maths</span>
                    <p>Mathematics is the foundation of science and technology. It helps us develop problem-solving and analytical thinking skills.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="200">
                <div class="member-img">
                    <img src="/public/images/instructor-ayse-kaya.jpg" class="img-fluid" alt="Dr. Ayşe Kaya">
                </div>
                <div class="member-info text-center">
                    <h4>Dr. Ayşe Kaya</h4>
                    <span>Marketing</span>
                    <p>Marketing focuses on understanding customer needs and promoting products effectively. It plays a key role in business growth and brand awareness.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="300">
                <div class="member-img">
                    <img src="/public/images/instructor-zeynep-demir.jpg" class="img-fluid" alt="Zeynep Demir, M.Sc.">
                </div>
                <div class="member-info text-center">
                    <h4>Zeynep Demir, M.Sc.</h4>
                    <span>Business</span>
                    <p>Business studies teach how companies operate, make decisions, and grow. It helps students understand management, finance, and entrepreneurship.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="400">
                <div class="member-img">
                    <img src="/public/images/instructor-elif-celik.jpg" class="img-fluid" alt="Prof. Dr. Elif Çelik">
                </div>
                <div class="member-info text-center">
                    <h4>Prof. Dr. Elif Çelik</h4>
                    <span>Physics</span>
                    <p>Physics explores the laws of nature and the universe. It helps us understand how things move, interact, and behave in the physical world.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="500">
                <div class="member-img">
                    <img src="/public/images/instructor-burak-sahin.jpg" class="img-fluid" alt="Dr. Burak Şahin">
                </div>
                <div class="member-info text-center">
                    <h4>Dr. Burak Şahin</h4>
                    <span>Web Development</span>
                    <p>Web Development involves creating and maintaining websites. It combines creativity and coding to build functional and user-friendly online platforms.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 member" data-aos="fade-up" data-aos-delay="600">
                <div class="member-img">
                    <img src="/public/images/instructor-mustafa-koc.jpg" class="img-fluid" alt="Mustafa Koç">
                </div>
                <div class="member-info text-center">
                    <h4>Mustafa Koç</h4>
                    <span>Business</span>
                    <p>Business helps us understand how organizations work, make profits, and create value. It is essential for leadership, strategy, and innovation.</p>
                </div>
            </div>
        </div>
    </div>

        <footer class="container">
            <p class="float-end"><a href="#">Back to top</a></p>
            <p>&copy; 2025 Online Tutoring Service &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
        </footer>

</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<script>
    function updateNavbarColor() {
        var scrollPosition = document.documentElement.scrollTop || document.body.scrollTop;
        var viewportHeight = window.innerHeight;
        const navbar = document.querySelector('.navbar');

        if (scrollPosition > (0.5 * viewportHeight)) {
            navbar.style.backgroundColor = '#9f4e58';
        } else {
            navbar.style.backgroundColor = '#7A242C';
        }
    }

    window.addEventListener('load', updateNavbarColor);
    window.addEventListener('scroll', updateNavbarColor);

    AOS.init({
        duration: 1000,
        once: true
    });
</script>
</body>
</html>