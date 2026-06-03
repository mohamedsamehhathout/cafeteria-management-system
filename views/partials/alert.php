<?php if(isset($_SESSION['success'])) : ?>

<div class="alert-success">
    <?= $_SESSION['success']; ?>
</div>

<?php endif; ?>