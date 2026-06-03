<?php require base_path('views/partials/head.php'); ?>
<form method="POST" action="/forgot-password">

    <div class="form-group">

        <label class="form-label">
            Email Address
        </label>

        <div class="input-wrap">

            <input
                class="form-control"
                type="email"
                name="email"
                required
            >

        </div>

    </div>

    <button type="submit" class="btn-login">
        Continue
    </button>

</form>
<?php require base_path('views/partials/footer.php'); ?>