<?php if ( isset( $_SESSION["error"] ) ) : ?>
    <div class="alert alert-danger" role="alert">
    <?= $_SESSION["error"]; ?>
    <?php 
        // Remove error message after it is shown (refresh page)
        unset( $_SESSION["error"] ); 
    ?>
    </div>
<?php endif; ?>