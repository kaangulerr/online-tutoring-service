<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>FAQ | Beykoz University</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: "Inter", sans-serif;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background: #f4f4f4;
        }

        .faq-button {
            position: fixed;
            bottom: 88px;
            right: 5px;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            border: none;
            background-image: linear-gradient(147deg, #ffe53b 0%, #ff2525 74%);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            transition: all 0.2s ease;
            z-index: 9999;
        }

        .faq-button svg {
            height: 1.5em;
            fill: white;
        }

        .faq-button:hover svg {
            animation: jello-vertical 0.7s both;
        }

        @keyframes jello-vertical {
            0% { transform: scale3d(1, 1, 1); }
            30% { transform: scale3d(0.75, 1.25, 1); }
            40% { transform: scale3d(1.25, 0.75, 1); }
            50% { transform: scale3d(0.85, 1.15, 1); }
            65% { transform: scale3d(1.05, 0.95, 1); }
            75% { transform: scale3d(0.95, 1.05, 1); }
            100% { transform: scale3d(1, 1, 1); }
        }

        .tooltip {
            position: absolute;
            bottom: 65px;
            right: 0;
            background-image: linear-gradient(147deg, #ffe53b 0%, #ff2525 74%);
            color: white;
            padding: 10px 14px;
            border-radius: 8px;
            white-space: nowrap;
            font-size: 14px;
            opacity: 0;
            transform: translateY(10px);
            transition: opacity 0.3s ease, transform 0.3s ease;
            z-index: 10000;
        }

        .tooltip::after {
            content: "";
            position: absolute;
            top: 100%;
            right: 18px;
            width: 12px;
            height: 12px;
            background-color: #ff2525;
            transform: rotate(45deg);
        }

        .faq-button:hover .tooltip {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
</head>
<body>

<a href="/public/" class="faq-button">
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
        <path d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74V320c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128H144C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/>
    </svg>
    <span class="tooltip">Having trouble choosing a course?</span>
</a>

</body>
</html>
