<div class="single-post">
    <div class="post-title">
        <h2><?php echo $post_title; ?></h2>
    </div>
    <div class="post-content">
        <p class="content"><?php echo $post_content; ?></p>
    </div>
    <?php
if ( gettype( $images ) === 'array' ) {
    foreach ( $images as $image ) {
        ?>
    <img src="<?php echo $image->image_url; ?>" alt="" srcset="">
    <?php
}
}
?>
</div>