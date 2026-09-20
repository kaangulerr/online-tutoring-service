<!doctype html>
<html lang="en" data-bs-theme="auto">
<head><script src="assets/js/color-modes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.122.0">
    <title>Home | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.3/examples/carousel/">



    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@docsearch/css@3">

    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .navbar {
            transition: background-color 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            height: 55px;
            min-height: 55px;
        }

        .navbar.navbar-transparent {
            background-color: transparent !important;
            box-shadow: none !important;
        }

        .navbar.navbar-scrolled {
            background-color: #7A242C !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1) !important;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse {
                background-color: #7A242C;
                padding: 15px;
                border-radius: 8px;
                margin-top: 10px;
            }
        }



        .contact {
            padding: 60px 0;
            background: #f9f9f9;
        }

        .contact .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .contact .section-title h2 {
            font-size: 32px;
            font-weight: 600;
            color: #333;
        }

        .contact .section-title p {
            font-size: 16px;
            color: #666;
            margin-top: 10px;
        }

        .contact .info-item {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
            transition: 0.3s ease;
        }



        .contact .info-item h3 {
            font-size: 20px;
            font-weight: 600;
            margin: 15px 0 5px;
            color: #222;
        }

        .contact .info-item p {
            margin-bottom: 0;
            font-size: 14px;
            color: #444;
        }

        .contact .php-email-form {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        }

        .contact .php-email-form input,
        .contact .php-email-form textarea {
            border-radius: 8px;
            box-shadow: none;
            font-size: 14px;
            padding: 12px 15px;
            border: 1px solid #ccc;
            width: 100%;
            transition: 0.3s;
        }

        .contact .php-email-form input:focus,
        .contact .php-email-form textarea:focus {
            border-color: #5cb874;
            outline: none;
        }

        .contact .php-email-form button[type="submit"] {
            background: #9f4e58;
            color: #fff;
            border: none;
            padding: 11px 15px;
            border-radius: 5px;
            transition: 0.3s;
            font-size: 16px;
        }

        .contact .php-email-form button[type="submit"]:hover {
            background: #7A242C;
        }

        .contact .loading,
        .contact .error-message,
        .contact .sent-message {
            display: none;
            font-size: 14px;
            margin-top: 10px;
        }

        .contact .loading {
            color: #999;
        }

        .contact .error-message {
            color: red;
        }

        .contact .sent-message {
            color: green;
        }

        .contact .section-title h2::after {
            content: "";
            display: block;
            width: 60px;
            height: 3px;
            background: #e03a3c;
            margin: 10px auto;
        }
        @media (max-width: 767px) {
            .navbar-nav .nav-link {
                color:white !important;
            }

            .navbar-nav .nav-link:hover {
                color: #adb5bd !important;
            }
        }

    </style>

    <link href="assets/css/carousel.css" rel="stylesheet">
</head>
<body>
<header data-bs-theme="dark">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>
</header>

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check2" viewBox="0 0 16 16">
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
    </symbol>
    <symbol id="circle-half" viewBox="0 0 16 16">
        <path d="M8 15A7 7 0 1 0 8 1v14zm0 1A8 8 0 1 1 8 0a8 8 0 0 1 0 16z"/>
    </symbol>
    <symbol id="moon-stars-fill" viewBox="0 0 16 16">
        <path d="M6 .278a.768.768 0 0 1 .08.858 7.208 7.208 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277.527 0 1.04-.055 1.533-.16a.787.787 0 0 1 .81.316.733.733 0 0 1-.031.893A8.349 8.349 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.752.752 0 0 1 6 .278z"/>
        <path d="M10.794 3.148a.217.217 0 0 1 .412 0l.387 1.162c.173.518.579.924 1.097 1.097l1.162.387a.217.217 0 0 1 0 .412l-1.162.387a1.734 1.734 0 0 0-1.097 1.097l-.387 1.162a.217.217 0 0 1-.412 0l-.387-1.162A1.734 1.734 0 0 0 9.31 6.593l-1.162-.387a.217.217 0 0 1 0-.412l1.162-.387a1.734 1.734 0 0 0 1.097-1.097l.387-1.162zM13.863.099a.145.145 0 0 1 .274 0l.258.774c.115.346.386.617.732.732l.774.258a.145.145 0 0 1 0 .274l-.774.258a1.156 1.156 0 0 0-.732.732l-.258.774a.145.145 0 0 1-.274 0l-.258-.774a1.156 1.156 0 0 0-.732-.732l-.774-.258a.145.145 0 0 1 0-.274l.774-.258c.346-.115.617-.386.732-.732L13.863.1z"/>
    </symbol>
    <symbol id="sun-fill" viewBox="0 0 16 16">
        <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8zM8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0zm0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13zm8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5zM3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8zm10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0zm-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0zm9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707zM4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708z"/>
    </symbol>
</svg>

<div class="dropdown position-fixed bottom-0 start-0 mb-3 ms-3 bd-mode-toggle">
    <button class="btn btn-bd-primary py-2 dropdown-toggle d-flex align-items-center"
            id="bd-theme"
            type="button"
            aria-expanded="false"
            data-bs-toggle="dropdown"
            aria-label="Toggle theme (auto)">
        <svg class="bi my-1 theme-icon-active" width="1em" height="1em"><use href="#circle-half"></use></svg>
        <span class="visually-hidden" id="bd-theme-text">Toggle theme</span>
    </button>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="bd-theme-text">
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="light" aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#sun-fill"></use></svg>
                Light
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center" data-bs-theme-value="dark" aria-pressed="false">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#moon-stars-fill"></use></svg>
                Dark
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
        <li>
            <button type="button" class="dropdown-item d-flex align-items-center active" data-bs-theme-value="auto" aria-pressed="true">
                <svg class="bi me-2 opacity-50" width="1em" height="1em"><use href="#circle-half"></use></svg>
                Auto
                <svg class="bi ms-auto d-none" width="1em" height="1em"><use href="#check2"></use></svg>
            </button>
        </li>
    </ul>
</div>





<main>
    <div id="myCarousel" class="carousel slide mb-6" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="d-block w-100" alt="Slide 1">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1>Invest in Your Future</h1>
                        <p class="opacity-75">Knowledge is the most powerful investment you can make. Start now, and the future will be yours!</p>
                        <p><a class="btn btn-lg btn-primary" href="/public/signup">Sign up today</a></p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="d-block w-100" alt="Slide 2">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Certification</h1>
                        <p>Enhance your career with a certificate from Beykoz University Open Courses!</p>
                        <p><a class="btn btn-lg btn-primary" href="/public/certification">Learn more</a></p>
                    </div>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1501504905252-473c47e087f8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80" class="d-block w-100" alt="Slide 3">
                <div class="container">
                    <div class="carousel-caption text-end">
                        <h1>Take the First Step</h1>
                        <p>Start today, explore our courses, and take your career to the next level with a valuable certification.</p>
                        <p><a class="btn btn-lg btn-primary" href="/public/dashboard">Explore Courses</a></p>
                    </div>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>


    <!-- Marketing messaging and featurettes
    ================================================== -->
    <!-- Wrap the rest of the page in another container to center all the content. -->

    <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div class="row">
            <div class="col-lg-4">
                <img src="/public/images/category-artificial-intelligence.webp" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Artificial Intelligence">
                <h2 class="fw-normal">Artificial Intelligence</h2>
                <p>The Artificial Intelligence course offered by Beykoz University is an open-access educational program designed for anyone interested in gaining fundamental knowledge and practical skills in artificial intelligence technologies. </p>
                <p><a class="btn btn-secondary" href="/public/course-details/AI_ML">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="/public/images/category-social-sciences.webp" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Social Sciences">
                <h2 class="fw-normal">Social Sciences</h2>
                <p>Beykoz University offers Social Sciences Open Courses designed for individuals who want to better understand society, culture, human behavior, and global issues.These courses cover diverse topics such as sociology, psychology, communication etc.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="/public/images/category-business.webp" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="Business">
                <h2 class="fw-normal">Business</h2>
                <p>Beykoz University offers Business Open Courses designed for individuals who want to gain valuable skills and knowledge to succeed in today’s competitive business world. These courses cover a wide range of topics including finance etc.</p>
                <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">About Beykoz University <span class="text-body-secondary">Open Courses</span></h2>
                <p class="lead">Beykoz University offers a wide range of Open Courses designed to make quality education accessible to everyone. These courses cover various fields, including technology, business, design, social sciences, and more. Whether you are a student, a professional, or simply someone eager to learn, Beykoz University Open Courses provide flexible and enriching learning opportunities.

                    Participants can access course materials anytime and study at their own pace, allowing them to balance learning with their personal and professional commitments.</p>
            </div>
            <div class="col-md-5">
                <img class="img" src="/public/images/banner-open-course.webp" width="500" height="500" alt="Open Course">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7 order-md-2">
                <h2 class="featurette-heading fw-normal lh-1">Course Content and  <span class="text-body-secondary">Learning Experience</span></h2>
                <p class="lead">Each Open Course is carefully designed by experienced instructors and industry experts. Courses typically combine theoretical knowledge with practical applications, enabling learners to gain real-world skills. Interactive materials such as video lectures, reading resources, quizzes, and assignments help ensure an engaging and effective learning experience.

                    No prior qualifications are required for most courses, making them suitable for learners from all backgrounds and levels of experience.</p>
            </div>
            <div class="col-md-5 order-md-1">
                <img class="img" src="/public/images/category-content-management.webp" width="500" height="500" alt="Content Management">
            </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
            <div class="col-md-7">
                <h2 class="featurette-heading fw-normal lh-1">Certification and Recognition <span class="text-body-secondary">Checkmate.</span></h2>
                <p class="lead">Upon successfully completing an Open Course, participants receive an Official Certificate of Completion from Beykoz University. This certificate can be added to resumes, LinkedIn profiles, and professional portfolios, helping learners showcase their achievements and newly acquired skills to employers and academic institutions.

                    By participating in Beykoz University’s Open Courses, learners not only expand their knowledge but also gain valuable credentials that can enhance their career prospects.</p>
            </div>
            <div class="col-md-5">
                <img class="img" src="/public/images/banner-certificate.webp" width="500" height="500" alt="Certificate">
            </div>
        </div>

        <hr class="featurette-divider">

        <!-- /END THE FEATURETTES -->

    </div><!-- /.container -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Contact</h2>
            <p>Get in touch with us for any questions or feedback.</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

            <div class="row gy-4">
                <div class="col-lg-6 ">
                    <div class="row gy-4">

                        <div class="col-lg-12">
                            <a href="/public/contact" style="text-decoration: none; color: inherit;">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                                    <img src="/public/images/icon-location.png" alt="Address Icon" style="width: 40px; height: 40px;">
                                    <h3>Address</h3>
                                    <p>Vatan Cd. No:69, 34805 Kavacık, Beykoz/İstanbul</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="/public/contact" style="text-decoration: none; color: inherit;">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                                    <img src="/public/images/icon-phone.png" alt="Phone Icon" style="width: 40px; height: 40px;">
                                    <h3>Call Us</h3>
                                    <p>0216 912 22 52</p>
                                </div>
                            </a>
                        </div>

                        <div class="col-md-6">
                            <a href="/public/contact" style="text-decoration: none; color: inherit;">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                                    <img src="/public/images/icon-email.png" alt="Email Icon" style="width: 40px; height: 40px;">
                                    <h3>Email Us</h3>
                                    <p>beykozopencourse@gmail.com</p>
                                </div>
                            </a>
                        </div>



                    </div>
                </div>

                <div class="col-lg-6">
                    <form method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="500">
                        <div class="row gy-4">

                            <div class="col-md-6">
                                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                            </div>

                            <div class="col-md-6 ">
                                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                            </div>

                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                            </div>

                            <div class="col-md-12">
                                <textarea class="form-control" name="message" rows="4" placeholder="Message" required=""></textarea>
                            </div>

                            <div class="col-md-12 text-center">
                                <div class="loading">Loading</div>
                                <div class="error-message"></div>
                                <div class="sent-message">Your message has been sent. Thank you!</div>

                                <button type="submit">Send Message</button>
                            </div>

                        </div>
                    </form>
                </div>




</main>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;

        function updateNavbar() {
            var scrollPosition = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;

            if (scrollPosition > 50) {
                navbar.classList.remove('navbar-transparent');
                navbar.classList.add('navbar-scrolled');
                navbar.style.setProperty('background-color', '#7A242C', 'important');
                navbar.style.setProperty('box-shadow', '0 2px 10px rgba(0,0,0,0.1)', 'important');
            } else {
                navbar.classList.add('navbar-transparent');
                navbar.classList.remove('navbar-scrolled');
                navbar.style.setProperty('background-color', 'transparent', 'important');
                navbar.style.setProperty('box-shadow', 'none', 'important');
            }
        }

        updateNavbar();
        window.addEventListener("scroll", updateNavbar, { passive: true });
        window.addEventListener("resize", updateNavbar, { passive: true });
    });

    const buttons = document.querySelectorAll('.dropdown-item');

    buttons.forEach(button => {
        button.addEventListener('click', function () {
            buttons.forEach(b => b.classList.remove('active'));
            button.classList.add('active');

            const themeValue = button.getAttribute('data-bs-theme-value');

            if (themeValue === 'light') {
                document.body.setAttribute('data-bs-theme', 'light');
            } else if (themeValue === 'dark') {
                document.body.setAttribute('data-bs-theme', 'dark');
            } else {
                document.body.removeAttribute('data-bs-theme');
            }
        });
    });
</script>
</body>
</html>
