<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Selection</title>
<style>
    /* ---------------------- */
    /* Global Styles */
    /* ---------------------- */
    body {
        margin: 0;
        padding: 0;
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: #f4f6f9;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    /* Container */
    .selection-container {
        background: #fff;
        padding: 40px 30px;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0,0,0,0.1);
        text-align: center;
        width: 90%;
        max-width: 400px;
    }

    h1 {
        color: #1e3a8a;
        margin-bottom: 25px;
    }

    p {
        font-size: 16px;
        margin-bottom: 30px;
        color: #555;
    }

    /* Buttons */
    .btn {
        display: inline-block;
        margin: 10px 15px;
        padding: 12px 25px;
        font-size: 16px;
        font-weight: bold;
        color: #fff;
        background: #1e3a8a;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background: #374ee2;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media(max-width: 500px){
        .btn {
            display: block;
            width: 80%;
            margin: 10px auto;
        }
    }
</style>
</head>
<body>

<div class="selection-container">
    <h1>Welcome to Online Bookstore</h1>
    <p>Please select your role to continue:</p>
    <a href="user.php" class="btn">User</a>
    <a href="admin.php" class="btn">Admin</a>
</div>

</body>
</html>
