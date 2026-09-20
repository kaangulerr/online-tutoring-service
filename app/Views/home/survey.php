<?php

?>

<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Survey | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="page-survey">
<?php include __DIR__ . '/../partials/spinner.php'; ?>

<?php include __DIR__ . '/../partials/navbar.php'; ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card p-4">
                <h2 class="mb-4 text-center">Personalized Course Recommendation Survey</h2>
                <form action="#" method="POST">

                    <div class="mb-4">
                        <label class="form-label fw-bold">1. Which topics are you most interested in?</label>
                        <p class="text-muted">You can select multiple options. Choose the areas that excite you the most.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="ai" id="ai">
                            <label class="form-check-label" for="ai">Artificial Intelligence & Machine Learning</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="cyber" id="cyber">
                            <label class="form-check-label" for="cyber">Cybersecurity & Information Assurance</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="data" id="data">
                            <label class="form-check-label" for="data">Database Management & Analytics</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="project" id="project">
                            <label class="form-check-label" for="project">Project Planning & Timeline Management</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="interests[]" value="software" id="software">
                            <label class="form-check-label" for="software">Software Engineering & System Design</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">2. What is your programming experience level?</label>
                        <p class="text-muted">Let us know your familiarity with programming and coding.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" value="none" id="expNone" required>
                            <label class="form-check-label" for="expNone">I have no programming experience</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" value="basic" id="expBasic">
                            <label class="form-check-label" for="expBasic">Basic level (if, for, variables)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" value="intermediate" id="expIntermediate">
                            <label class="form-check-label" for="expIntermediate">Intermediate (functions, databases, classes)</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="experience" value="advanced" id="expAdvanced">
                            <label class="form-check-label" for="expAdvanced">Advanced (backend, APIs, security, built projects)</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">3. What is your main motivation for taking a course?</label>
                        <p class="text-muted">Your goal helps us recommend the most relevant content.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="goal" value="career" id="goalCareer" required>
                            <label class="form-check-label" for="goalCareer">To improve my career</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="goal" value="certificate" id="goalCert">
                            <label class="form-check-label" for="goalCert">To earn a certificate</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="goal" value="cv" id="goalCV">
                            <label class="form-check-label" for="goalCV">To enhance my CV</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="goal" value="interest" id="goalInt">
                            <label class="form-check-label" for="goalInt">Just for personal interest</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">4. On average, how much time can you dedicate per day?</label>
                        <p class="text-muted">Your availability helps us match the right pace of learning.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="time" value="low" id="timeLow" required>
                            <label class="form-check-label" for="timeLow">Less than 30 minutes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="time" value="medium" id="timeMedium">
                            <label class="form-check-label" for="timeMedium">30 to 60 minutes</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="time" value="high" id="timeHigh">
                            <label class="form-check-label" for="timeHigh">1 to 2 hours</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="time" value="intense" id="timeIntense">
                            <label class="form-check-label" for="timeIntense">More than 2 hours</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">5. How do you prefer to learn?</label>
                        <p class="text-muted">Tell us your ideal learning method.</p>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="learning_style" value="video" id="learnVideo" required>
                            <label class="form-check-label" for="learnVideo">Watching videos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="learning_style" value="theory" id="learnTheory">
                            <label class="form-check-label" for="learnTheory">Reading theory/documentation</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="learning_style" value="project" id="learnProject">
                            <label class="form-check-label" for="learnProject">Hands-on projects</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="learning_style" value="quiz" id="learnQuiz">
                            <label class="form-check-label" for="learnQuiz">Practicing with quizzes/tests</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">6. What types of projects interest you?</label>
                        <p class="text-muted">You can select more than one option.</p>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="project_type[]" value="web" id="projWeb"><label class="form-check-label" for="projWeb">Web development and UI design</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="project_type[]" value="ml" id="projML"><label class="form-check-label" for="projML">AI and Machine Learning projects</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="project_type[]" value="network" id="projNet"><label class="form-check-label" for="projNet">Network and security systems</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="project_type[]" value="database" id="projDB"><label class="form-check-label" for="projDB">Database design and analytics</label></div>
                        <div class="form-check"><input class="form-check-input" type="checkbox" name="project_type[]" value="game" id="projGame"><label class="form-check-label" for="projGame">Simple games or simulations</label></div>
                    </div>

                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary btn-lg">Recommend a Course for Me</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>

