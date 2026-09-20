
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Admin Dashboard | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/dashboard/">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <link href="/public/css/app.css" rel="stylesheet">
    <link href="/public/css/dashboard.css" rel="stylesheet">
</head>
<body class="admin-page">
<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Open Course | Online Tutoring Service</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
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
                        <a class="nav-link <?php echo $active_tab === 'dashboard' ? 'active' : ''; ?>" href="/public/admin?tab=dashboard">
                            <span data-feather="home"></span>
                            Dashboard <?php echo $active_tab === 'dashboard' ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active_tab === 'products' ? 'active' : ''; ?>" href="/public/admin?tab=products">
                            <span data-feather="shopping-cart"></span>
                            All Courses <?php echo $active_tab === 'products' ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active_tab === 'customers' ? 'active' : ''; ?>" href="/public/admin?tab=customers">
                            <span data-feather="users"></span>
                            Customers <?php echo $active_tab === 'customers' ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active_tab === 'mails' ? 'active' : ''; ?>" href="/public/admin?tab=mails">
                            <span data-feather="mail"></span>
                            Mails <?php echo $active_tab === 'mails' ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo $active_tab === 'courses' ? 'active' : ''; ?>" href="/public/admin?tab=courses">
                            <span data-feather="plus-circle"></span>
                            Add New Course <?php echo $active_tab === 'courses' ? '<span class="sr-only">(current)</span>' : ''; ?>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h1 class="h2">
                    <?php
                    if ($active_tab === 'customers') echo 'Customers';
                    elseif ($active_tab === 'products') echo 'Products';
                    elseif ($active_tab === 'mails') echo 'Messages';
                    elseif ($active_tab === 'courses') echo 'Add New Course';
                    else echo 'Dashboard';
                    ?>
                </h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                </div>
            </div>

            <?php if ($active_tab === 'dashboard'): ?>
                <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

                <h2>Pro Package Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th># ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Course</th>
                            <th>Payment Completed</th>
                            <th>Payment Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results as $row):
                            
                            $name_parts = explode(' ', $row['username'], 2);
                            $name = $name_parts[0];
                            $surname = isset($name_parts[1]) ? $name_parts[1] : '';
                            
                            $payment_date = date('d-m-Y H:i', strtotime($row['payment_at']));
                            $date_parts = explode(' ', $payment_date);
                            $date_only = $date_parts[0]; 
                            $time_only = $date_parts[1]; 
                            $day = substr($date_only, 0, 2); 
                            $rest_of_date = substr($date_only, 2); 
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($name); ?></td>
                                <td><?php echo htmlspecialchars($surname); ?></td>
                                <td>All Courses (Pro Package)</td>
                                <td><?php echo htmlspecialchars($pro_package_price); ?> $</td>
                                <td><strong><?php echo htmlspecialchars($day); ?></strong><?php echo htmlspecialchars($rest_of_date . ' ' . $time_only); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($active_tab === 'customers'): ?>
                <h2>All Users</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th># ID</th>
                            <th>Name</th>
                            <th>Surname</th>
                            <th>Email</th>
                            <th>Pro Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results as $row):
                            
                            $name_parts = explode(' ', $row['username'], 2);
                            $name = $name_parts[0];
                            $surname = isset($name_parts[1]) ? $name_parts[1] : '';
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($name); ?></td>
                                <td><?php echo htmlspecialchars($surname); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td><?php echo $row['isPro'] ? 'Pro' : 'Free'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($active_tab === 'products'): ?>
                <h2>All Courses</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th># ID</th>
                            <th>Course Title</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['title']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($active_tab === 'mails'): ?>
                <h2>Messages</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th># ID</th>
                            <th>User</th>
                            <th>Subject</th>
                            <th>Message</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($results as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['username'] ?? 'Unknown'); ?></td>
                                <td><?php echo htmlspecialchars($row['subject']); ?></td>
                                <td><?php echo htmlspecialchars(substr($row['message'], 0, 100)) . (strlen($row['message']) > 100 ? '...' : ''); ?></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($results)): ?>
                            <tr>
                                <td colspan="4">No messages found.</td>
                            </tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php elseif ($active_tab === 'courses'): ?>
                <?php if (\App\Core\Flash::has('success')): \App\Core\Flash::get('success'); ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        Course added successfully.
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                <?php endif; ?>
                <?php if (\App\Core\Flash::get('error') === 'duplicate'): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        This course code already exists.
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                    </div>
                <?php endif; ?>

                <form method="POST" action="/public/admin/courses/add" enctype="multipart/form-data" class="mb-4 pb-3 border-bottom">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Course Title</label>
                            <input type="text" name="title" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Course Code</label>
                            <input type="text" name="code" class="form-control form-control-sm" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Instructor Name</label>

                            <select id="instructor_select" class="form-control form-control-sm" onchange="handleInstructorChange(this)" required>
                                <option value="">Select an instructor...</option>
                                <?php foreach ($instructors as $inst): ?>
                                    <option value="<?= htmlspecialchars($inst) ?>"><?= htmlspecialchars($inst) ?></option>
                                <?php endforeach; ?>
                                <option value="__NEW__">+ Add New Instructor</option>
                            </select>
                            <input type="text" id="instructor_new" class="form-control form-control-sm mt-2" placeholder="Enter new instructor name" style="display:none;" oninput="document.getElementById('instructor_real').value = this.value">
                            <input type="hidden" name="instructor_name" id="instructor_real" value="">
                            
                            <script>
                                const instructorImages = <?= json_encode($instructorImages) ?>;
                                
                                function handleInstructorChange(selectElem) {
                                    const realInput = document.getElementById('instructor_real');
                                    const newInput = document.getElementById('instructor_new');
                                    
                                    const imgUploadRow = document.getElementById('instructor_image_upload_row');
                                    const imgFileInputContainer = document.getElementById('instructor_image_file_container');
                                    const imgPreviewBox = document.getElementById('pv2');
                                    const imgPreviewImg = imgPreviewBox.querySelector('img');
                                    const existingImageHidden = document.getElementById('existing_instructor_image');
                                    
                                    if (selectElem.value === '__NEW__') {
                                        newInput.style.display = 'block';
                                        newInput.required = true;
                                        realInput.value = newInput.value;
                                        
                                        imgUploadRow.style.display = 'flex';
                                        imgFileInputContainer.style.display = 'block';
                                        imgPreviewBox.style.display = 'none';
                                        imgPreviewImg.src = '';
                                        if(existingImageHidden) existingImageHidden.value = '';
                                    } else {
                                        newInput.style.display = 'none';
                                        newInput.required = false;
                                        realInput.value = selectElem.value;
                                        
                                        if (instructorImages[selectElem.value]) {
                                            imgUploadRow.style.display = 'flex';
                                            imgFileInputContainer.style.display = 'none';
                                            imgPreviewBox.style.display = 'flex';
                                            imgPreviewImg.src = instructorImages[selectElem.value];
                                            if(existingImageHidden) existingImageHidden.value = instructorImages[selectElem.value];
                                        } else {
                                            imgUploadRow.style.display = 'flex';
                                            imgFileInputContainer.style.display = 'block';
                                            imgPreviewBox.style.display = 'none';
                                            imgPreviewImg.src = '';
                                            if(existingImageHidden) existingImageHidden.value = '';
                                        }
                                    }
                                }
                            </script>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Course Image</label>
                            <div class="upload-row">
                                <div class="custom-file" style="flex:1">
                                    <input type="file" name="image_path" id="image_path" class="custom-file-input" accept="image/*" onchange="previewImage(this,'pv1')">
                                    <label class="custom-file-label" for="image_path" data-browse="Browse">Choose file...</label>
                                </div>
                                <div id="pv1" class="img-preview-box">
                                    <button type="button" class="cancel-btn" onclick="cancelImage('image_path','pv1')">x</button>
                                    <img src="" alt="">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="small text-muted">Instructor Image (optional)</label>
                            <div class="upload-row" id="instructor_image_upload_row">
                                <div class="custom-file" id="instructor_image_file_container" style="flex:1">
                                    <input type="file" name="instructor_image" id="instructor_image" class="custom-file-input" accept="image/*" onchange="previewImage(this,'pv2')">
                                    <label class="custom-file-label" for="instructor_image" data-browse="Browse">Choose file...</label>
                                </div>
                                <div id="pv2" class="img-preview-box">
                                    <button type="button" class="cancel-btn" onclick="cancelImage('instructor_image','pv2'); document.getElementById('instructor_image_file_container').style.display='block'; document.getElementById('existing_instructor_image').value='';">x</button>
                                    <img src="" alt="">
                                </div>
                            </div>
                            <input type="hidden" name="existing_instructor_image" id="existing_instructor_image" value="">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-sm btn-outline-secondary">Add Course</button>
                    </div>
                </form>

                <form method="POST" action="/public/admin/courses/delete" class="form-inline mb-4 pb-3 border-bottom justify-content-end">
                    <?= \App\Core\CSRF::csrfField() ?>
                    <label class="small text-muted mr-2">Delete by ID:</label>
                    <input type="number" name="id" class="form-control form-control-sm mr-2" placeholder="ID" required style="max-width:120px">
                    <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                </form>

                <h2>All Courses</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-sm">
                        <thead>
                        <tr>
                            <th># ID</th>
                            <th>Course Title</th>
                            <th>Code</th>
                            <th>Image</th>
                            <th>Detail</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (!empty($courses)): ?>
                            <?php foreach ($courses as $row): ?>
                                <tr>
                                    <td><?= $row['id'] ?></td>
                                    <td><?= htmlspecialchars($row['title']) ?></td>
                                    <td><?= htmlspecialchars($row['code']) ?></td>
                                    <td><?php if (!empty($row['image_path'])): ?><img src="<?= htmlspecialchars($row['image_path']) ?>" width="40" style="border-radius:3px"><?php else: ?>&mdash;<?php endif; ?></td>
                                    <td><a href="/public/admin/courses/<?= $row['id'] ?>/content" class="btn btn-sm btn-outline-primary">Manage</a></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr><td colspan="5" class="text-muted">No courses added yet.</td></tr>
                        <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <script>
                    function previewImage(input, id) {
                        var box = document.getElementById(id);
                        var img = box.querySelector('img');
                        var label = input.nextElementSibling;
                        if (input.files && input.files[0]) {
                            if (label) label.textContent = input.files[0].name;
                            var r = new FileReader();
                            r.onload = function(e) { img.src = e.target.result; box.style.display = 'block'; }
                            r.readAsDataURL(input.files[0]);
                        } else {
                            if (label) label.textContent = 'Choose file...';
                            box.style.display = 'none'; img.src = '';
                        }
                    }
                    function cancelImage(inputId, previewId) {
                        var input = document.getElementById(inputId);
                        input.value = '';
                        var label = input.nextElementSibling;
                        if (label) label.textContent = 'Choose file...';
                        var box = document.getElementById(previewId);
                        box.style.display = 'none';
                        box.querySelector('img').src = '';
                    }
                </script>
            <?php endif; ?>
        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
<script>
    (function () {
        'use strict'
        feather.replace()

        <?php if ($active_tab === 'dashboard'): ?>
        var ctx = document.getElementById('myChart')
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($labels); ?>,
                datasets: [{
                    label: 'Pro Package Sales',
                    data: <?php echo json_encode($graph_data); ?>,
                    lineTension: 0,
                    backgroundColor: 'transparent',
                    borderColor: '#007bff',
                    borderWidth: 4,
                    pointBackgroundColor: '#007bff'
                }]
            },
            options: {
                scales: {
                    yAxes: [{ ticks: { beginAtZero: true } }],
                    xAxes: [{
                        ticks: {
                            autoSkip: true,
                            maxTicksLimit: 20
                        }
                    }]
                },
                legend: { display: false },
                title: { display: true, text: 'Daily Pro Package Sales' }
            }
        })
        <?php endif; ?>
    })();
</script>
</body>
</html>