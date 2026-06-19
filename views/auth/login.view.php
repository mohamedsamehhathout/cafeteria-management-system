<?php require base_path('views/partials/head.php'); ?>
<div class="login-page">

    <div class="left-panel">

        <div class="blob"></div>
        <div class="blob2"></div>

        <div class="brand">

            

            <h1 class="brand-name">
                Café<span>Desk</span>
            </h1>

            <p class="brand-tagline">
                Cafeteria Management Platform
            </p>

        </div>

        <div class="features">

            <div class="feature-item">

                

                <div>
                    <h4>Order From Your Desk</h4>
                    <p>Browse products and place orders easily.</p>
                </div>

            </div>

            <div class="feature-item">

                

                <div>
                    <h4>Track Orders</h4>
                    <p>Follow your order status in real time.</p>
                </div>

            </div>

            <div class="feature-item">

                

                <div>
                    <h4>Admin Dashboard</h4>
                    <p>Manage products, users and reports.</p>
                </div>

            </div>

        </div>

    </div>

    <div class="right-panel">

        <div class="form-header">

            <h2>Welcome back, </h2><h3>Dear customer</h3>

            <p>
                Sign in to your CaféDesk account
            </p>

        </div>

            <?php if (isset($errors['auth'])) : ?>

                <div class="alert-error">

                    <?= $errors['auth'] ?>

                </div>

            <?php endif; ?>

        <form method="POST" action="/login">

            <div class="form-group">

                <label class="form-label">
                    Email Address
                </label>

                <div class="input-wrap">

                    

                    <input
                        class="form-control"
                        type="email"
                        name="email"
                        required>
                    

                </div>

            </div>

            <div class="form-group">

                <label class="form-label">
                    Password
                </label>

                <div class="input-wrap">


                    <input
                        class="form-control"
                        type="password"
                        name="password"
                        required
                    >

                </div>

            </div>
            
            <button type="submit" class="btn-login">
                Sign In →
            </button>
            <a href="/forgot-password" class="forgot-link">
                Forgot password?
            </a>

        </form>

        <div class="copyright">
            © 2026 CaféDesk
        </div>

    </div>

</div>
<?php require base_path('views/partials/footer.php'); ?>