<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .account-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .account-header {
            text-align: center;
        }

        .account-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .account-details {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-picture img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-right: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        .account-actions {
            text-align: center;
            margin-bottom: 20px;
        }

        .account-actions button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .account-actions button:hover {
            background-color: #0056b3;
        }

        .recent-activities {
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .recent-activities h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .recent-activities ul {
            list-style-type: none;
            padding: 0;
        }

        .recent-activities li {
            background-color: #f9f9f9;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="account-container">
        <div class="account-header">
            <h1>Hello, <span id="username">John Doe</span>!</h1>
        </div>
        <div class="account-details">
            <div class="profile-picture">
                <img src="profile.jpg" alt="Profile Picture" id="profilePic">
            </div>
            <div class="info">
                <p>Email: <span id="email">john.doe@example.com</span></p>
                <p>Phone: <span id="phone">123-456-7890</span></p>
            </div>
        </div>
        <div class="account-actions">
            <button onclick="updateInfo()">Update Information</button>
        </div>
        <div class="recent-activities">
            <h2>Recent Activities</h2>
            <ul id="activities">
                <li>Logged in from a new device.</li>
                <li>Updated profile picture.</li>
                <li>Changed password.</li>
            </ul>
        </div>
    </div>
    <script>
        function updateInfo() {
            alert("Update Information feature is not implemented yet.");
        }
    </script>
</body>
</html>
