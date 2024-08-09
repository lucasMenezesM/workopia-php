<?php $successMessage = Session::getFlashMessage("success_message") ?>
<?php if ($successMessage !== null): ?>
    <div class="messagse bg-green-100 p-3 my-3">
        <?= $successMessage; ?>
    </div>
<?php endif ?>

<?php $errorMessage = Session::getFlashMessage("error_message") ?>
<?php if ($errorMessage !== null): ?>
    <div class="messagse bg-green-100 p-3 my-3">
        <?= $errorMessage; ?>
    </div>
<?php endif ?>