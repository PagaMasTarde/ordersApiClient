<div class="fixed-top">
    <?php
    if (!areKeysSet()) {
        echo showKeysMissingErrorMessage();
    } ?>
</div>
<nav class="navbar navbar-light bg-transparent justify-content-center">
    <a class="navbar-brand" href="#" onclick="redirectHome()">
        <img src="../assets/pics/Pagantis_Logo_RGB.svg"  alt="">
    </a>
</nav>
