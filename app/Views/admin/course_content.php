
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Manage Course Content | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/public/css/app.css" rel="stylesheet">
    <link href="/public/css/dashboard.css" rel="stylesheet">
</head>
<body class="admin-page">

<?php if (\App\Core\Flash::has('success')): ?>
    <div class="alert alert-success alert-success-toast shadow-sm">
        <?php $success = \App\Core\Flash::get('success'); ?>
        <?php if ($success === 'content_added'): ?>
            Video/content added successfully!
        <?php elseif ($success === 'question_added'): ?>
            Exam question added successfully!
        <?php elseif ($success === 'detail_saved'): ?>
            Course landing page saved successfully!
        <?php else: ?>
            Operation completed successfully!
        <?php endif; ?>
    </div>
<?php endif; ?>

<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="/public/admin">Open Course | Admin</a>
    <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
            <a class="nav-link" href="/public/admin/logout">Sign out</a>
        </li>
    </ul>
</nav>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
            <div class="sidebar-sticky pt-3">
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="/public/admin?tab=dashboard">
                            <span data-feather="home"></span> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/admin?tab=products">
                            <span data-feather="shopping-cart"></span> All Courses
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/admin?tab=customers">
                            <span data-feather="users"></span> Customers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/public/admin?tab=mails">
                            <span data-feather="mail"></span> Mails
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/public/admin?tab=courses">
                            <span data-feather="plus-circle"></span> Add New Course
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="pt-3 pb-2 mb-3 border-bottom">
                <a href="/public/admin?tab=courses" class="back-link text-muted">
                    &larr; Back to Courses
                </a>
                <h1 class="h2 mt-2">
                    <?= htmlspecialchars($course['title']) ?>
                    <small class="text-muted">(<?= htmlspecialchars($course['code']) ?>)</small>
                </h1>
            </div>

            <?php
            $d = $detail ?? [];
            $existingLearnItems = json_decode($d['learn_items'] ?? '[]', true) ?: [];
            $existingIncludes   = json_decode($d['includes_info'] ?? '[]', true) ?: [];
            ?>
            <div class="section-card">
                <div class="section-title" style="border-bottom-color: #6f42c1;">
                    <span data-feather="layout"></span>
                    Course Landing Page
                    <?php if (!empty($d)): ?>
                        <span class="badge badge-info badge-count">Configured</span>
                        <a href="/public/course-details/<?= htmlspecialchars($course['code']) ?>" target="_blank" class="btn btn-sm btn-outline-info ml-2">Preview ↗</a>
                    <?php else: ?>
                        <span class="badge badge-secondary badge-count">Not set</span>
                    <?php endif; ?>
                </div>

                <form method="POST" action="/public/admin/courses/detail/save">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">

                    <div class="form-row">
                        <div class="col-md-4 mb-2">
                            <label class="small text-muted">Badge Text</label>
                            <input type="text" name="badge_text" class="form-control form-control-sm" placeholder="e.g. Security Focused" value="<?= htmlspecialchars($d['badge_text'] ?? '') ?>">
                        </div>
                        <div class="col-md-8 mb-2">
                            <label class="small text-muted">Subtitle / Description</label>
                            <input type="text" name="subtitle" class="form-control form-control-sm" placeholder="Short description about the course" value="<?= htmlspecialchars($d['subtitle'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted">Rating</label>
                            <input type="number" name="detail_rating" class="form-control form-control-sm" step="0.1" min="0" max="5" placeholder="4.6" value="<?= htmlspecialchars($d['rating'] ?? '') ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted">Rating Count</label>
                            <input type="number" name="rating_count" class="form-control form-control-sm" placeholder="2450" value="<?= htmlspecialchars($d['rating_count'] ?? '') ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted">Student Count</label>
                            <input type="number" name="student_count" class="form-control form-control-sm" placeholder="5120" value="<?= htmlspecialchars($d['student_count'] ?? '') ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted">Language</label>
                            <input type="text" name="language" class="form-control form-control-sm" placeholder="English" value="<?= htmlspecialchars($d['language'] ?? 'English') ?>">
                        </div>
                        <div class="col-md-2 mb-2">
                            <label class="small text-muted">Last Updated</label>
                            <input type="text" name="last_updated" class="form-control form-control-sm" placeholder="09/2026" value="<?= htmlspecialchars($d['last_updated'] ?? '') ?>">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="small text-muted">Preview Video URL (YouTube embed)</label>
                            <input type="url" name="preview_video_url" class="form-control form-control-sm" placeholder="https://www.youtube.com/embed/..." value="<?= htmlspecialchars($d['preview_video_url'] ?? '') ?>">
                        </div>
                    </div>

                    <hr>

                    <div class="mb-3">
                        <label class="small text-muted font-weight-bold">What You Will Learn</label>
                        <div id="learnItemsContainer">
                            <?php if (!empty($existingLearnItems)): ?>
                                <?php foreach ($existingLearnItems as $item): ?>
                                    <div class="input-group input-group-sm mb-1 learn-item-row">
                                        <input type="text" name="learn_items[]" class="form-control" value="<?= htmlspecialchars($item) ?>">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger" onclick="this.closest('.learn-item-row').remove()">&times;</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="input-group input-group-sm mb-1 learn-item-row">
                                    <input type="text" name="learn_items[]" class="form-control" placeholder="e.g. Database security essentials">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.learn-item-row').remove()">&times;</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="addLearnItem()">+ Add Item</button>
                    </div>

                    <div class="mb-3">
                        <label class="small text-muted font-weight-bold">This Course Includes</label>
                        <div id="includesContainer">
                            <?php if (!empty($existingIncludes)): ?>
                                <?php foreach ($existingIncludes as $info): ?>
                                    <div class="input-group input-group-sm mb-1 includes-row">
                                        <input type="text" name="includes_info[]" class="form-control" value="<?= htmlspecialchars($info) ?>">
                                        <div class="input-group-append">
                                            <button type="button" class="btn btn-outline-danger" onclick="this.closest('.includes-row').remove()">&times;</button>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="input-group input-group-sm mb-1 includes-row">
                                    <input type="text" name="includes_info[]" class="form-control" placeholder="e.g. 8.5 hours of video content">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.includes-row').remove()">&times;</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-secondary mt-1" onclick="addIncludesItem()">+ Add Item</button>
                    </div>

                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">Save Landing Page</button>
                    </div>
                </form>
            </div>

            <div class="section-card" id="section-videos">
                <div class="section-title">
                    <span data-feather="video"></span>
                    Course Videos / Contents
                    <span class="badge badge-primary badge-count"><?= count($contents) ?></span>
                </div>

                <form method="POST" action="/public/admin/courses/content/add" class="mb-4 pb-3 border-bottom">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                    <div class="form-row">
                        <div class="col-md-6 mb-2">
                            <label class="small text-muted">Video Title *</label>
                            <input type="text" name="title" class="form-control form-control-sm" placeholder="e.g. Introduction to the Course" required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small text-muted">Video URL * (YouTube embed or direct link)</label>
                            <input type="url" name="video_url" class="form-control form-control-sm" placeholder="https://www.youtube.com/embed/..." required>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="small text-muted">Description (optional)</label>
                            <input type="text" name="description" class="form-control form-control-sm" placeholder="Brief description of this video">
                        </div>
                        <div class="col-md-4 mb-2">
                            <label class="small text-muted">File URL (optional, downloadable resource)</label>
                            <input type="url" name="file_url" class="form-control form-control-sm" placeholder="https://example.com/file.pdf">
                        </div>
                        <div class="col-md-2 mb-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary btn-sm btn-block">Add Content</button>
                        </div>
                    </div>
                </form>

                <?php if (!empty($contents)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Video URL</th>
                                <th>File</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($contents as $i => $c): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($c['title']) ?></td>
                                    <td class="text-muted small"><?= htmlspecialchars($c['description'] ?? '—') ?></td>
                                    <td>
                                        <a href="<?= htmlspecialchars($c['video_url']) ?>" target="_blank" class="small">
                                            View ↗
                                        </a>
                                    </td>
                                    <td>
                                        <?php if (!empty($c['file_url'])): ?>
                                            <a href="<?= htmlspecialchars($c['file_url']) ?>" target="_blank" class="small">Download ↗</a>
                                        <?php else: ?>
                                            &mdash;
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <form method="POST" action="/public/admin/courses/content/delete" class="d-inline delete-form">
                                            <?= \App\Core\CSRF::csrfField() ?>
                                            <input type="hidden" name="content_id" value="<?= $c['id'] ?>">
                                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-btn" data-message="Are you sure you want to delete this video/content?">&times;</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted small mb-0">No video/content added yet. Use the form above to add the first one.</p>
                <?php endif; ?>
            </div>

            <div class="section-card" id="section-questions">
                <div class="section-title exam">
                    <span data-feather="help-circle"></span>
                    Exam Questions
                    <span class="badge badge-success badge-count"><?= count($questions) ?></span>
                    <?php if (count($questions) < 10): ?>
                        <small class="text-danger ml-2">(Minimum 10 questions needed for exams)</small>
                    <?php endif; ?>
                </div>

                <form method="POST" action="/public/admin/courses/question/add" class="mb-4 pb-3 border-bottom">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                    <div class="form-row">
                        <div class="col-12 mb-2">
                            <label class="small text-muted">Question *</label>
                            <input type="text" name="question" class="form-control form-control-sm" placeholder="Enter the exam question..." required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted">Option A *</label>
                            <input type="text" name="option_a" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted">Option B *</label>
                            <input type="text" name="option_b" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted">Option C *</label>
                            <input type="text" name="option_c" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted">Option D *</label>
                            <input type="text" name="option_d" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-3 mb-2">
                            <label class="small text-muted">Correct Answer *</label>
                            <select name="correct_answer" class="form-control form-control-sm" required>
                                <option value="">Select...</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="C">C</option>
                                <option value="D">D</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-success btn-sm btn-block">Add Question</button>
                        </div>
                    </div>
                </form>

                <?php if (!empty($questions)): ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-sm">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>A</th>
                                <th>B</th>
                                <th>C</th>
                                <th>D</th>
                                <th>Answer</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($questions as $i => $q): ?>
                                <tr>
                                    <td><?= $i + 1 ?></td>
                                    <td><?= htmlspecialchars($q['question']) ?></td>
                                    <td class="small"><?= htmlspecialchars($q['option_a']) ?></td>
                                    <td class="small"><?= htmlspecialchars($q['option_b']) ?></td>
                                    <td class="small"><?= htmlspecialchars($q['option_c']) ?></td>
                                    <td class="small"><?= htmlspecialchars($q['option_d']) ?></td>
                                    <td><span class="badge badge-success"><?= htmlspecialchars($q['correct_answer']) ?></span></td>
                                    <td>
                                        <form method="POST" action="/public/admin/courses/question/delete" class="d-inline delete-form">
                                            <?= \App\Core\CSRF::csrfField() ?>
                                            <input type="hidden" name="question_id" value="<?= $q['id'] ?>">
                                            <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
                                            <button type="button" class="btn btn-outline-danger btn-sm delete-btn" data-message="Are you sure you want to delete this exam question?">&times;</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted small mb-0">No exam questions added yet. Use the form above to add questions.</p>
                <?php endif; ?>
            </div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>

<div class="modal fade" id="deleteConfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title text-danger">
                    <span data-feather="alert-triangle" style="width:20px;height:20px"></span>
                    Confirm Delete
                </h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body pt-2">
                <p id="deleteModalMessage" class="mb-0 text-muted">Are you sure?</p>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-sm btn-danger" id="confirmDeleteBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

    <script src="/public/js/app.js"></script>
</body>
</html>

