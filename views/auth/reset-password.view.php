<?php require base_path('views/partials/head.php'); ?>
<div class="reset-page">

    <div class="bg-decor">

        <div class="bg-circle bg-circle-1"></div>

        <div class="bg-circle bg-circle-2"></div>

    </div>

    <div class="reset-card">

        <div class="reset-icon">
            🔐
        </div>

        <h2 class="reset-title">
            Set New Password
        </h2>

        <p class="reset-subtitle">
            Create a strong password for your account.
        </p>

        <form method="POST" action="/reset-password">

            <div class="form-group">

                <label class="form-label">
                    New Password
                </label>

                <div class="password-wrap">

                    <input
                        class="form-control"
                        type="password"
                        name="password"
                        placeholder="Enter new password"
                        required
                    >

                </div>

            </div>

            <div class="form-group">

                <label class="form-label">
                    Confirm Password
                </label>

                <div class="password-wrap">

                    <input
                        class="form-control"
                        type="password"
                        name="confirm_password"
                        placeholder="Confirm new password"
                        required
                    >

                </div>

            </div>

            <button
                type="submit"
                class="btn-reset"
            >
                Update Password
            </button>

        </form>

        <a
            href="/login"
            class="back-link"
        >
            ← Back to Login
        </a>

    </div>

</div>
<?php require base_path('views/partials/footer.php'); ?>