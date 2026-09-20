    <!DOCTYPE html>
    <html lang="tr">
    <head>
        <meta charset="UTF-8">
        <title><?= htmlspecialchars($course['title'] ?? 'Course Content') ?> | Beykoz University</title>
        <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/app.css">
    </head>
    <body class="page-view">
    <?php include __DIR__ . '/../partials/navbar.php'; ?>

    <div class="container-fluid mt-5 px-4">
        <div class="row">
            <div class="col-lg-8 mb-4">
                <div class="card shadow-sm" id="video-section">
                    <div class="card-body">
                        <div id="videoTitle" class="video-title mb-2">Video Title</div>
                        <div id="videoDescription" class="video-description mb-3">Video Description</div>
                        <div class="ratio ratio-16x9 mb-3" id="videoContainer">
                            <iframe id="videoFrame" src="/placeholder.svg" allowfullscreen></iframe>
                        </div>
                        <a id="videoFile" href="#" target="_blank" class="btn btn-outline-primary d-none">
                            <i class="bi bi-download me-1"></i>Download File
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-primary text-white fw-bold">
                        <i class="bi bi-list-task me-1"></i> Course Contents
                    </div>
                    <ul class="list-group list-group-flush" id="courseList"></ul>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="progress" role="progressbar" aria-label="Course Progress">
                            <div id="courseProgress" class="progress-bar" style="width: 0%">0%</div>
                        </div>

                        <div id="completionMessage" class="mt-3 text-success fw-bold d-none text-center">
                            <i class="bi bi-check-circle-fill"></i> Congratulations! You have completed all videos!
                        </div>

                        <div id="examSection" class="mt-3 exam-section p-3 d-none">
                            <div class="text-center">
                                <h5 class="text-primary mb-3">
                                    <i class="bi bi-clipboard-check"></i> Final Exam
                                </h5>
                                <p class="text-muted mb-3">
                                    Complete the final exam to earn your certificate.<br>
                                    <small>You need to score at least 70% to pass.</small>
                                </p>
                                <button id="startExamBtn" class="btn btn-warning fw-bold">
                                    <i class="bi bi-play-circle"></i> Start Exam
                                </button>
                            </div>
                        </div>

                        <div id="certificateSection" class="mt-3 text-success fw-bold d-none text-center">
                            <div class="alert alert-success">
                                <i class="bi bi-trophy"></i> Exam Passed!<br>
                                <small>Score: <span id="examScore"></span>%</small>
                            </div>
                            <a href="/public/certificate?course_id=<?= htmlspecialchars($course_id) ?>&user_id=<?= htmlspecialchars($user_id) ?>"
                               class="btn btn-success" target="_blank">
                                <i class="bi bi-award"></i> Download Your Certificate
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="examModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">
                        <i class="bi bi-clipboard-check"></i> Final Exam
                    </h5>
                </div>
                <div class="modal-body">
                    <div id="examContent">
                        <div class="text-center">
                            <div class="spinner-border text-primary" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mt-2">Loading exam questions...</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" id="submitExamBtn" class="btn btn-primary d-none">Submit Exam</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const contents = <?= json_encode($contents, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
        const courseId = <?= $course_id ?>;
        const examPassed = <?= $exam_passed ? 'true' : 'false' ?>;
        const examScore = <?= $exam_passed ? $exam_passed['score'] : 0 ?>;
        const csrfToken = <?= json_encode(\App\Core\CSRF::generateToken()) ?>;
        const courseList = document.getElementById('courseList');
        let watchedCount = 0;

        function renderCourseList() {
            contents.forEach((content, index) => {
                const li = document.createElement('li');
                li.className = 'list-group-item course-item d-flex justify-content-between align-items-center';

                const watchedIcon = content.watched > 0
                    ? '<i class="bi bi-check-circle-fill text-success"></i>'
                    : '<i class="bi bi-circle text-muted"></i>';

                if (content.watched > 0) watchedCount++;

                li.innerHTML = `
                <div>
                    <div class="fw-semibold">${content.title}</div>
                    <small class="text-muted">${content.description}</small>
                </div>
                ${watchedIcon}
            `;
                li.addEventListener('click', () => loadContent(index));
                courseList.appendChild(li);
            });
        }

        function loadContent(index) {
            const content = contents[index];
            document.getElementById('videoTitle').innerText = content.title;
            document.getElementById('videoDescription').innerText = content.description;
            document.getElementById('videoFrame').src = content.video_url;

            const fileBtn = document.getElementById('videoFile');
            if (content.file_url && content.file_url.trim() !== '') {
                fileBtn.href = content.file_url;
                fileBtn.classList.remove('d-none');
            } else {
                fileBtn.classList.add('d-none');
            }

            fetch('/public/course/mark-watched', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    content_id: content.id,
                    csrf_token: csrfToken
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data && data.success) {
                        const icon = courseList.children[index].querySelector('i');
                        if (!icon.classList.contains('bi-check-circle-fill')) {
                            icon.className = 'bi bi-check-circle-fill text-success';
                            watchedCount++;
                            updateProgress();
                        }
                    }
                });

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function updateProgress() {
            const total = contents.length;
            const percent = Math.round((watchedCount / total) * 100);
            const bar = document.getElementById('courseProgress');
            bar.style.width = `${percent}%`;
            bar.textContent = `${percent}%`;

            if (percent === 100) {
                document.getElementById('completionMessage').classList.remove('d-none');

                if (examPassed) {
                    document.getElementById('certificateSection').classList.remove('d-none');
                    document.getElementById('examScore').textContent = examScore;
                } else {
                    document.getElementById('examSection').classList.remove('d-none');
                }
            }
        }

        let examQuestions = [];
        let currentAnswers = {};

        document.getElementById('startExamBtn').addEventListener('click', function() {
            loadExam();
        });

        function loadExam() {
            fetch(`/public/course/exam-questions?course_id=${courseId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        examQuestions = data.questions;
                        renderExam();
                        new bootstrap.Modal(document.getElementById('examModal')).show();
                    } else {
                        alert('Error loading exam questions: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error loading exam questions');
                });
        }

        function renderExam() {
            const examContent = document.getElementById('examContent');
            let html = '<form id="examForm">';

            examQuestions.forEach((question, index) => {
                html += `
                    <div class="mb-4">
                        <h6 class="fw-bold">Question ${index + 1}:</h6>
                        <p>${question.question}</p>
                        <div class="ms-3">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question.id}" value="A" id="q${question.id}_a">
                                <label class="form-check-label" for="q${question.id}_a">${question.option_a}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question.id}" value="B" id="q${question.id}_b">
                                <label class="form-check-label" for="q${question.id}_b">${question.option_b}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question.id}" value="C" id="q${question.id}_c">
                                <label class="form-check-label" for="q${question.id}_c">${question.option_c}</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="question_${question.id}" value="D" id="q${question.id}_d">
                                <label class="form-check-label" for="q${question.id}_d">${question.option_d}</label>
                            </div>
                        </div>
                    </div>
                `;
            });

            html += '</form>';
            examContent.innerHTML = html;
            document.getElementById('submitExamBtn').classList.remove('d-none');
        }

        document.getElementById('submitExamBtn').addEventListener('click', function() {
            const formData = new FormData(document.getElementById('examForm'));
            const answers = {};

            examQuestions.forEach(question => {
                const answer = formData.get(`question_${question.id}`);
                if (answer) {
                    answers[question.id] = answer;
                }
            });

            if (Object.keys(answers).length !== examQuestions.length) {
                alert('Please answer all questions before submitting.');
                return;
            }

            submitExam(answers);
        });

        function submitExam(answers) {
            fetch("/public/course/submit-exam", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    course_id: courseId,
                    answers: answers
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        bootstrap.Modal.getInstance(document.getElementById('examModal')).hide();

                        if (data.passed) {
                            document.getElementById('examSection').classList.add('d-none');
                            document.getElementById('certificateSection').classList.remove('d-none');
                            document.getElementById('examScore').textContent = data.score;
                            alert(`Congratulations! You passed the exam with ${data.score}%`);
                        } else {
                            alert(`You scored ${data.score}%. You need at least 70% to pass. Please try again.`);
                        }
                    } else {
                        alert('Error submitting exam: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error submitting exam');
                });
        }

        if (contents.length > 0) {
            renderCourseList();
            updateProgress();
            loadContent(0);
        } else {
            courseList.innerHTML = '<li class="list-group-item text-muted">No content available for this course.</li>';
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    </body>
    </html>
