<?php if ( isset( $_SESSION["success"] ) ) : ?>
    <div class="alert alert-success" role="alert">
    <?= $_SESSION["success"]; ?>
    <?php 
        // Remove success message after it is shown (refresh page)
        unset( $_SESSION["success"] ); 
    ?>
    </div>
<?php endif; ?>