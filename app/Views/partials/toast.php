<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .custom-toast-wrapper {
            position: fixed;
            top: 60px;
            right: 20px;
            z-index: 9999;
            width: 300px;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif !important;
            display: flex;
            flex-direction: column;
            gap: 15px;
            pointer-events: none;
        }

        .custom-toast-wrapper * {
            box-sizing: border-box !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        .custom-toast-notification {
            background: linear-gradient(135deg, #ff6b6b, #ee5a24) !important;
            color: white !important;
            border-radius: 10px !important;
            padding: 12px 14px !important;
            box-shadow: 0 8px 25px rgba(238, 90, 36, 0.3) !important;
            transform: translateX(350px) !important;
            opacity: 0 !important;
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
            position: relative !important;
            overflow: hidden !important;
            width: 100% !important;
            border: none !important;
            outline: none !important;
            pointer-events: auto;
        }

        .custom-toast-notification.second {
            background: linear-gradient(135deg, #4facfe, #00f2fe) !important;
            box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3) !important;
        }

        .custom-toast-notification::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            right: 0 !important;
            height: 3px !important;
            background: linear-gradient(90deg, #ffd700, #ff8c00) !important;
            animation: custom-toast-progress 6s linear forwards !important;
        }

        .custom-toast-notification.second::before {
            background: linear-gradient(90deg, #00f2fe, #4facfe) !important;
            animation: custom-toast-progress 6s linear forwards !important;
        }

        .custom-toast-notification.show {
            transform: translateX(0) !important;
            opacity: 1 !important;
        }

        .custom-toast-notification.hide {
            transform: translateX(350px) !important;
            opacity: 0 !important;
        }

        .custom-toast-notification.moving-up {
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94) !important;
        }

        .custom-toast-header {
            display: flex !important;
            align-items: center !important;
            justify-content: space-between !important;
            margin-bottom: 4px !important;
        }

        .custom-toast-icon {
            font-size: 18px !important;
            margin-right: 8px !important;
            animation: custom-toast-bounce 2s infinite !important;
            line-height: 1 !important;
        }

        .custom-toast-title {
            font-size: 14px !important;
            font-weight: 700 !important;
            display: flex !important;
            align-items: center !important;
            flex: 1 !important;
            color: white !important;
            line-height: 1.2 !important;
        }

        .custom-toast-close-btn {
            background: rgba(255, 255, 255, 0.2) !important;
            border: none !important;
            color: white !important;
            width: 22px !important;
            height: 22px !important;
            border-radius: 50% !important;
            cursor: pointer !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            font-size: 12px !important;
            transition: all 0.3s ease !important;
            backdrop-filter: blur(10px) !important;
            outline: none !important;
            line-height: 1 !important;
        }

        .custom-toast-close-btn:hover {
            background: rgba(255, 255, 255, 0.3) !important;
            transform: scale(1.1) !important;
        }

        .custom-toast-message {
            font-size: 12px !important;
            line-height: 1.4 !important;
            opacity: 0.95 !important;
            margin-left: 26px !important;
            margin-right: 5px !important;
            color: white !important;
        }

        .custom-toast-badge {
            display: inline-block !important;
            background: rgba(255, 255, 255, 0.25) !important;
            padding: 2px 6px !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            font-size: 10px !important;
            margin-left: 6px !important;
            animation: custom-toast-pulse 2s infinite !important;
            color: white !important;
            line-height: 1 !important;
        }

        .custom-toast-highlight {
            color: #ffd700 !important;
            font-weight: 700 !important;
        }

        .custom-toast-notification.second .custom-toast-highlight {
            color: #ffffff !important;
            font-weight: 700 !important;
        }

        .custom-toast-cta-link {
            display: inline-block !important;
            margin-top: 4px !important;
            color: white !important;
            text-decoration: underline !important;
            font-weight: 500 !important;
            font-size: 11px !important;
            opacity: 0.9 !important;
            transition: opacity 0.2s !important;
            cursor: pointer !important;
        }

        .custom-toast-cta-link:hover {
            opacity: 1 !important;
            color: white !important;
            text-decoration: underline !important;
        }

        @keyframes custom-toast-progress {
            from { width: 100%; }
            to { width: 0%; }
        }

        @keyframes custom-toast-bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-6px);
            }
            60% {
                transform: translateY(-3px);
            }
        }

        @keyframes custom-toast-pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        @media (max-width: 480px) {
            .custom-toast-wrapper {
                right: 10px !important;
                left: 10px !important;
                width: auto !important;
            }

            .custom-toast-notification {
                transform: translateY(-100px) !important;
            }

            .custom-toast-notification.show {
                transform: translateY(0) !important;
            }

            .custom-toast-notification.hide {
                transform: translateY(-100px) !important;
            }
        }
    </style>
</head>
<body>
<div class="custom-toast-wrapper" id="customToastContainer">
    <?php if (!$has_paid): ?>
    <div id="customFirstToast" class="custom-toast-notification">
        <div class="custom-toast-header">
            <div class="custom-toast-title">
                <span class="custom-toast-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #ffd700; vertical-align: middle;">
                        <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
                    </svg>
                </span>
                Upgrade to Pro!
                <span class="custom-toast-badge">$15/mo</span>
            </div>
            <button class="custom-toast-close-btn" onclick="closeCustomToast('customFirstToast')" aria-label="Close">
                &times;
            </button>
        </div>
        <div class="custom-toast-message">
            <span class="custom-toast-highlight">Unlimited access</span> to all courses & certificates!
            <a href="/public/pricing" class="custom-toast-cta-link" onclick="handleCustomUpgradeClick()">Learn more &rarr;</a>
        </div>
    </div>
    <?php endif; ?>

    <div id="customSecondToast" class="custom-toast-notification second">
        <div class="custom-toast-header">
            <div class="custom-toast-title">
                <span class="custom-toast-icon">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: #4facfe; vertical-align: middle;">
                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                    </svg>
                </span>
                New Course Available
                <span class="custom-toast-badge">HOT</span>
            </div>
            <button class="custom-toast-close-btn" onclick="closeCustomToast('customSecondToast')" aria-label="Close">
                &times;
            </button>
        </div>
        <div class="custom-toast-message">
            <span class="custom-toast-highlight">Database Management and Analytics</span> with MySQL
            <a href="/public/course-details/DB_MN" class="custom-toast-cta-link" onclick="handleCustomCourseClick()">Learn more &rarr;</a>
        </div>
    </div>
</div>

<script>
    let customToastTimeouts = {};

    function showCustomToast(id, delay = 0) {
        setTimeout(() => {
            const toast = document.getElementById(id);
            if (toast) {
                toast.classList.add("show");

                customToastTimeouts[id] = setTimeout(() => {
                    closeCustomToast(id);
                }, 6000);
            }
        }, delay);
    }

    function closeCustomToast(id) {
        const toast = document.getElementById(id);
        if (toast) {
            toast.classList.remove("show");
            toast.classList.add("hide");

            if (customToastTimeouts[id]) {
                clearTimeout(customToastTimeouts[id]);
            }

            if (id === 'customFirstToast') {
                const secondToast = document.getElementById('customSecondToast');
                if (secondToast && secondToast.classList.contains('show')) {
                    setTimeout(() => {
                        secondToast.classList.add("slide-up");
                    }, 150);

                    setTimeout(() => {
                        toast.style.display = 'none';
                    }, 400);
                }
            }
        }
    }

    function handleCustomUpgradeClick() {
        console.log("Pro upgrade link clicked!");
        closeCustomToast('customFirstToast');
    }

    function handleCustomCourseClick() {
        console.log("Course link clicked!");
        closeCustomToast('customSecondToast');
    }

    window.addEventListener('load', () => {
        <?php if (!$has_paid): ?>
        showCustomToast('customFirstToast', 500);
        showCustomToast('customSecondToast', 2500);
        <?php endif; ?>
    });

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            closeCustomToast('customFirstToast');
            closeCustomToast('customSecondToast');
        }
    });

    window.showCustomToast = showCustomToast;
    window.closeCustomToast = closeCustomToast;
</script>
</body>
</html>
