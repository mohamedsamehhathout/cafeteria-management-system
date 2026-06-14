<?php require base_path('views/partials/head.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password – CaféDesk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background: linear-gradient(135deg, #6F4E37, #8B6347);
        }
        .reset-container {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1);
            max-width: 400px;
            width: 100%;
        }
        h2 {
            color: #2C1A0E;
            margin-bottom: 10px;
        }
        p {
            color: #888;
            margin-bottom: 30px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #4A3020;
            font-weight: 600;
            font-size: 13px;
        }
        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #eee;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: all 0.2s;
        }
        input:focus {
            outline: none;
            border-color: #6F4E37;
            background: #fafafa;
        }
        button {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #6F4E37, #8B6347);
            color: white;
            border: none;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(111,78,55,0.3);
        }
        a {
            color: #6F4E37;
            text-decoration: none;
            font-size: 13px;
            margin-top: 20px;
            display: block;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="reset-container">
    <h2>Reset Your Password</h2>
    <p>Enter your email address and we'll send you instructions to reset your password.</p>

    <form method="POST">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" name="email" placeholder="you@company.com" required>
        </div>
        <button type="submit">Send Reset Link →</button>
    </form>

    <a href="/login">Back to Login</a>
</div>

</body>
</html>
