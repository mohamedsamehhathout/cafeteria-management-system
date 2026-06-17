<?php require base_path('views/partials/head.php'); ?>
<?php require base_path('views/partials/navbar.php'); ?>
<form method="POST" action="/forgot-password">

    <div class="forgot">

        <label class="form-label" id="forgot-label">
            Email Address
        </label>

        <div class="input-wrap">

            <input
                class="forgot-control"
                type="email"
                name="email"
                required
            >

        </div>
 <button type="submit" class="btn-continue">
        Continue
    </button>
    </div>

   

</form>
<?php require base_path('views/partials/footer.php'); ?>