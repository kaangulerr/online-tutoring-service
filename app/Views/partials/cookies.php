<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="overlay" id="pageOverlay">
    <div class="card" id="cookiePopup">
        <svg id="cookieSvg" viewBox="0 0 24 24"><g><path d="M12 2a10 10 0 1 0 10 10A10.011 10.011 0 0 0 12 2Zm3.5 3.25a1.25 1.25 0 1 1-1.25 1.25 1.25 1.25 0 0 1 1.25-1.25ZM9 5.5a1 1 0 1 1-1 1 1 1 0 0 1 1-1Zm-3 4a1 1 0 1 1-1 1 1 1 0 0 1 1-1Zm7 9.5a1.5 1.5 0 1 1 1.5-1.5 1.5 1.5 0 0 1-1.5 1.5Zm1-6a1 1 0 1 1 1-1 1 1 0 0 1-1 1Zm3.5 2a1 1 0 1 1 1-1 1 1 0 0 1-1 1Z"></path></g></svg>
        <div class="cookieHeading">We use cookies!</div>
        <div class="cookieDescription">
            We use cookies to ensure you get the best experience on our website.
            <a href="#">Learn more</a>
        </div>
        <div class="buttonContainer">
            <button class="acceptButton" onclick="acceptCookies()">Accept</button>
            <button class="declineButton" disabled>Decline</button>
        </div>
    </div>
</div>

<script src="script.js"></script>
</body>
</html>
