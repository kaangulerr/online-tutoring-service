<?php

$teachers = [
    'ahmet' => [
        'name' => 'Prof. Dr. Ahmet Yılmaz',
        'subject' => 'Artificial Intelligence',
        'image' => '/public/images/instructor-ahmet-yilmaz.jpg',
        'color' => '#e91e63',
        'position' => 'left'
    ],
    'ayse' => [
        'name' => 'Dr. Ayşe Kaya',
        'subject' => 'Cybersecurity',
        'image' => '/public/images/instructor-ayse-kaya.jpg',
        'color' => '#2196f3',
        'position' => 'left'
    ],
    'zeynep' => [
        'name' => 'Zeynep Demir, M.Sc.',
        'subject' => 'Data Science',
        'image' => '/public/images/instructor-zeynep-demir.jpg',
        'color' => '#9c27b0',
        'position' => 'left'
    ],
    'elif' => [
        'name' => 'Prof. Dr. Elif Çelik',
        'subject' => 'Software Engineering',
        'image' => '/public/images/instructor-elif-celik.jpg',
        'color' => '#4caf50',
        'position' => 'left'
    ],
    'burak' => [
        'name' => 'Dr. Burak Şahin',
        'subject' => 'Computer Networks',
        'image' => '/public/images/instructor-burak-sahin.jpg',
        'color' => '#ff9800',
        'position' => 'left'
    ],
    'mustafa' => [
        'name' => 'Mustafa Koç',
        'subject' => 'Computer Graphics and Visualization',
        'image' => '/public/images/instructor-mustafa-koc.jpg',
        'color' => '#795548',
        'position' => 'left'
    ]
];

function call_api($endpoint, $data) {
    $baseUrl = \App\Core\Env::get('AI_CHAT_API_URL', '');
    if (empty($baseUrl)) {
        return ["error" => "AI Chat API endpoint is not configured in .env (AI_CHAT_API_URL)."];
    }
    $url = rtrim($baseUrl, '/') . '/' . ltrim($endpoint, '/');
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        $error_msg = curl_error($ch);
        curl_close($ch);
        return ["error" => $error_msg];
    }

    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        return ["error" => "HTTP Error: $http_code"];
    }

    $decoded_response = json_decode($response, true);

    if (isset($decoded_response['discussion']) || isset($decoded_response['response'])) {
        return [
            'responses' => [
                [
                    'professor_id' => $data['professors'][0],
                    'professor_name' => $GLOBALS['teachers'][$data['professors'][0]]['name'],
                    'response' => $decoded_response['discussion'] ?? $decoded_response['response']
                ]
            ]
        ];
    }

    return ["error" => "Invalid API response format"];
}


if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ajax'])) {
    header('Content-Type: application/json');

    $selected_teacher = $_POST['teacher'] ?? '';
    $question = trim($_POST['question'] ?? '');

    if (empty($selected_teacher) || empty($question)) {
        echo json_encode(["error" => "Please select a professor and write your question."]);
        exit;
    }

    $data = [
        "professors" => [$selected_teacher],
        "topic" => $question,
        "comments" => [],
        "constraint" => "Please provide a concise response in 3-4 sentences. Avoid lengthy explanations."
    ];

    $response = call_api("discussion", $data);
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Chat | Beykoz University</title>
    <link rel="icon" type="image/png" sizes="32x32" href="/public/images/favicon.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/public/images/favicon.png">
    <link rel="stylesheet" href="/public/css/app.css">
</head>
<body class="page-ai-chat">
<div class="chat-container">
    <div class="teachers-sidebar">
        <div class="sidebar-header">
            <div class="sidebar-title">AI Professor Chat</div>
            <div class="sidebar-subtitle">Select a professor and start the conversation!</div>
        </div>

        <div class="teachers-list">

            <?php foreach ($teachers as $id => $teacher): ?>
                <div class="teacher-item"
                     data-teacher="<?= $id ?>"
                     data-name="<?= htmlspecialchars($teacher['name']) ?>"
                     data-image="<?= $teacher['image'] ?>"
                     data-position="<?= $teacher['position'] ?>"
                     data-color="<?= $teacher['color'] ?>">
                    <img src="<?= $teacher['image'] ?>" alt="<?= htmlspecialchars($teacher['name']) ?>" class="teacher-avatar">
                    <div class="teacher-details">
                        <div class="teacher-name"><?= htmlspecialchars($teacher['name']) ?></div>
                        <div class="teacher-subject"><?= htmlspecialchars($teacher['subject']) ?></div>
                    </div>
                    <div class="selection-badge">✓</div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="selected-summary">
            <div class="selected-count" id="selectedCount">
                No professor selected yet
            </div>
        </div>
    </div>

    <div class="chat-area">
        <div class="chat-header">
            <div class="chat-title">Chat</div>
            <div class="active-teachers-display" id="activeTeachersDisplay"></div>
        </div>

        <div class="chat-messages" id="chatMessages">
            <div class="welcome-screen" id="welcomeScreen">
                <div class="welcome-icon">
                    <svg width="44" height="44" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" style="color: #4f46e5;">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                </div>
                <div class="welcome-title">Welcome!</div>
                <div class="welcome-description">
                    Select a professor from the left and ask your questions.<br>
                    Your professor will respond!
                </div>
            </div>
        </div>

        <div class="chat-input">
            <div class="input-wrapper">
                <textarea
                        class="message-input"
                        id="messageInput"
                        placeholder="Write your question here..."
                        rows="1"
                ></textarea>
                <button class="send-button" id="sendButton">Send</button>
            </div>
        </div>
    </div>
</div>

    <script src="/public/js/app.js"></script>
</body>
</html>