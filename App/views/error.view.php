<?php loadPartial("head") ?>
<!-- Nav -->
<?php loadPartial("navbar") ?>
<!-- Top Banner -->

<section>
    <div class="container mx-auto p-4 mt-4">
        <div class="text-center text-3xl mb-4 font-bold border border-gray-300 p-3"> <?= $httpCode ?>
            Error</div>
        <p class="text-center text-2xl mb-4">
            <?= $message ?>
        </p>
    </div>
</section>

<!-- Bottom Banner -->
<?php loadPartial("footer"); ?>