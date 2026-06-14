<?php require base_path('views/partials/head.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – CaféDesk</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #6F4E37;
            --secondary: #D9A066;
            --bg: #F8F5F2;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            background: var(--bg);
        }

        .left-panel {
            width: 52%;
            background: linear-gradient(145deg, #2C1A0E 0%, #4A3020 40%, #6F4E37 100%);
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px;
            overflow: hidden;
        }

        .left-panel .blob {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(217,160,102,0.18) 0%, transparent 70%);
            position: absolute;
            top: -100px;
            right: -100px;
            border-radius: 50%;
        }

        .brand {
            position: relative;
            z-index: 2;
        }

        .brand-emoji {
            font-size: 56px;
            display: block;
            margin-bottom: 16px;
        }

        .brand-name {
            font-size: 40px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 6px;
        }

        .brand-name span {
            color: var(--secondary);
        }

        .brand-tagline {
            font-size: 15px;
            color: rgba(255,255,255,0.55);
            font-weight: 400;
        }

        .right-panel {
            width: 48%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 60px 64px;
            background: #fff;
        }

        .form-header {
            margin-bottom: 36px;
        }

        .form-header h2 {
            font-size: 28px;
            font-weight: 800;
            color: #2C1A0E;
            margin-bottom: 6px;
        }

        .form-header p {
            font-size: 14px;
            color: #888;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #4A3020;
            margin-bottom: 8px;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 16px;
            color: #ccc;
        }

        .form-control {
            width: 100%;
            padding: 12px 14px 12px 42px;
            border: 2px solid #eee;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
            background: #fafafa;
        }

        .form-control:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(111,78,55,0.08);
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .forgot-link {
            font-size: 13px;
            color: var(--primary);
            font-weight: 600;
            text-decoration: none;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), #8B6347);
            color: white;
            border: none;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 20px rgba(111,78,55,0.35);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(111,78,55,0.45);
        }

        .copyright {
            margin-top: 40px;
            text-align: center;
            font-size: 12px;
            color: #ccc;
        }

        .alert {
            margin-bottom: 20px;
            padding: 12px 14px;
            border-radius: 8px;
            font-size: 13px;
        }

        .alert-danger {
            background: #fee;
            color: #c33;
            border: 1px solid #fcc;
        }
    </style>
</head>
<body>

<div class="left-panel">
    <div class="blob"></div>
    <div class="brand">
        <span class="brand-emoji">☕</span>
        <h1 class="brand-name">Café<span>Desk</span></h1>
        <p class="brand-tagline">Cafeteria Management Platform</p>
    </div>
</div>

<div class="right-panel">
    <div class="form-header">
        <h2>Welcome back 👋</h2>
        <p>Sign in to your CaféDesk account to continue</p>
    </div>

    <?php if (isset($_GET['error'])): ?>
        <div class="alert alert-danger">Invalid email or password</div>
    <?php endif; ?>

    <form method="POST">
        <div class="form-group">
            <label class="form-label">Email Address</label>
            <div class="input-wrap">
                <span class="input-icon">✉️</span>
                <input
                    class="form-control"
                    type="email"
                    name="email"
                    placeholder="you@company.com"
                    required
                >
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Password</label>
            <div class="input-wrap">
                <span class="input-icon">🔒</span>
                <input
                    class="form-control"
                    type="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                >
            </div>
        </div>

        <div class="form-options">
            <a href="/forgot-password" class="forgot-link">Forgot password?</a>
        </div>

        <button type="submit" class="btn-login">Sign In →</button>
    </form>

    <p class="copyright">© 2024 CaféDesk · Secure & Encrypted</p>
</div>

</body>
</html>
